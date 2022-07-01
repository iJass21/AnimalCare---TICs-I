#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

#include <EEPROM.h>

#define EEPROM_SIZE 32
#define SYNC_PIN D1
#define LED_ROJO_PIN D2
#define LED_AMARILLO_PIN D3

WiFiClient wifiClient;

const char *ssid = "Redmi 10";
const char *password = "t123456s";

String host = "18.117.224.152";

String id_dispositivo;

void setup() {
  // Establece los pines como salida
  pinMode(BUILTIN_LED, OUTPUT);
  pinMode(SYNC_PIN, OUTPUT);
  pinMode(LED_ROJO_PIN, OUTPUT);
  pinMode(LED_AMARILLO_PIN, OUTPUT);

  // ID del dispositivo la cual el usuario utilizara
  id_dispositivo = "1";

  delay(1000);
  
  Serial.begin(115200);

  // Resetea el modo de WiFi
  WiFi.mode(WIFI_OFF);
  delay(1000);
  WiFi.mode(WIFI_STA);

  // Escribe a la memoria permanente del modulo la informacion sobre el WiFi
  EEPROM.begin(EEPROM_SIZE);

  int address = 0;
  EEPROM.put(address, ssid);
  address += sizeof(ssid);
  EEPROM.put(address, password);
  EEPROM.commit();

  address = 0;
  EEPROM.get(address, ssid);
  address += sizeof(ssid);
  EEPROM.get(address, password);

  EEPROM.end();

  conectarWifi(ssid, password);
  
  digitalWrite(SYNC_PIN, HIGH);
}

unsigned long tiempo = 5000;
int periodo = 5000;

String alldata;

String temp, luz, humedad, uv;
void loop() {
  // Checkeo de desconexion
  if (WiFi.status() != WL_CONNECTED) {
    conectarWifi(ssid, password);  
  }

  // Lee los datos enviados cada [periodo] milisegundos
  if(millis() > tiempo + periodo) {
    tiempo = millis();

    // Marca al arduino que podemos recibir informacion
    digitalWrite(SYNC_PIN, HIGH);
    
    delay(100);

    digitalWrite(SYNC_PIN, LOW);
    
    if (Serial.available()) {
      digitalWrite(BUILTIN_LED, LOW);
      
      alldata = Serial.readString();

      // Dividimos la informacion la cual es recibida en un unico String a cuatro Strings
      temp = alldata.substring(0, alldata.indexOf("&"));
      luz = alldata.substring(alldata.indexOf("&") + 1, alldata.indexOf("&", temp.length() + 1));
      humedad = alldata.substring(alldata.indexOf("&", temp.length() + 1) + 1, alldata.indexOf("&", temp.length() + luz.length() + 2));
      uv = alldata.substring(alldata.indexOf("&", temp.length() + luz.length() + 2) + 1, alldata.indexOf("&", temp.length() + luz.length() + humedad.length() + 3));

      digitalWrite(BUILTIN_LED, HIGH);
      
      Serial.println("Datos: ");
      Serial.println(temp);
      Serial.println(luz);
      Serial.println(humedad);
      Serial.println(uv);
    }

    // Envio de datos por POST al servidor web
    HTTPClient http;

    String postData = "id_dispositivo=" + id_dispositivo + "&temp=" + temp + "&luz=" + luz + "&humedad=" + humedad + "&uv=" + uv;
  
    http.begin(wifiClient, "http://" + host + "/BDD_Control/GuardarRegistro.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  
    int httpCode = http.POST(postData);
    String payload = http.getString();
  
    Serial.println(payload);
  
    http.end();
  }
}

int wifi_timeout = 30000;
unsigned long wifi_ptime = 0;

void conectarWifi(const char *ssid, const char *contrasenia) {
  digitalWrite(LED_AMARILLO_PIN, LOW);
  digitalWrite(LED_ROJO_PIN, HIGH);
  
  bool conectado = false;
  String s = ssid;

  wifi_ptime = millis();

  // Ciclo infinito hasta lograr conectar
  while (!conectado) {
    WiFi.begin(ssid, contrasenia);
    Serial.print("\nConectando");
    
    while (WiFi.status() != WL_CONNECTED) {
      // Intentar la conexion actual hasta [wifi_timeout] milisegundos
      if (millis() > wifi_ptime + wifi_timeout) {
        wifi_ptime = millis();
        Serial.println("\nNo fue posible conectarse a " + s);
        break;
      }

      delay(500);
      Serial.print(".");
    }

    conectado = WiFi.status() == WL_CONNECTED;
  }

  digitalWrite(LED_ROJO_PIN, LOW);
  digitalWrite(LED_AMARILLO_PIN, HIGH);
  
  Serial.println("\nConectado a: " + s);
  Serial.print("Direccion IP: ");
  Serial.println(WiFi.localIP());
}
