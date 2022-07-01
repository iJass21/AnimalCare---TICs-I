#include <dht.h>
#include <SoftwareSerial.h>
#include <string.h>
dht DHT;

#define DHT11_PIN A0
#define LUZ_PIN A1
#define UV_PIN A4
#define SYNC_PIN 4

SoftwareSerial espSerial(2, 3);
String str;

void setup() {
  // Establece los pines como entrada de datos
  pinMode(SYNC_PIN, INPUT);
  pinMode(LUZ_PIN, INPUT);
  pinMode(UV_PIN, INPUT);
  
  Serial.begin(9600);
  espSerial.begin(115200);
  delay(1000);
}

long total_humedad, total_temp, total_luz, total_uv = 0;
long cant_humedad, cant_temp, cant_luz, cant_uv = 0;
long prom_humedad, prom_temp, prom_luz, prom_uv = 0;

int periodo = 3000;
unsigned long tiempo = 0;

void loop() {
  int chk = DHT.read11(DHT11_PIN);

  // Lectura de los sensores
  total_humedad += (int)DHT.humidity;
  total_temp += (int)DHT.temperature;
  total_luz += sensorALuxes((int)analogRead(LUZ_PIN));
  total_uv += (int)analogRead(UV_PIN);

  cant_humedad++;
  cant_temp++;
  cant_luz++;
  cant_uv++;

  // Calculo del promedio cada [periodo] milisegundos
  if (millis() > periodo + tiempo) {
    tiempo = millis();

    prom_humedad = total_humedad / cant_humedad;
    prom_temp = total_temp / cant_temp;
    prom_luz = total_luz / cant_luz;
    prom_uv = total_uv / cant_uv;

    total_humedad = 0;
    total_temp = 0;
    total_luz = 0;
    total_uv = 0;
    
    cant_humedad = 0;
    cant_temp = 0;
    cant_luz = 0; 
    cant_uv = 0;
  }


  // Envio de los promedios por comunicacion Serial al NodeMCU
  // NodeMCU envia voltaje a SYNC_PIN cuando esta listo para recibir informacion
  if (digitalRead(SYNC_PIN) == HIGH) {
    str = String(prom_temp) + String("&") + String(prom_luz) + String("&") + String(prom_humedad) + String("&") + String(prom_uv);
    Serial.println(prom_temp);
    Serial.println(prom_luz);
    Serial.println(prom_humedad);
    Serial.println(prom_uv);
    Serial.println("----------");

    espSerial.write(str.c_str()); // Envia a los pines TX/RX de NodeMCU

    delay(100); // Delay para que el arduino no envie demasiada informacion a la vez
  }
}

int sensorALuxes(int sensor){
  const float constante_conversion = 1023;
  
  const int resistencia = 1000;
  const int volts = 5;
  
  float Vout = float(sensor) * (volts / constante_conversion); // Analogo a voltaje
  float RLDR = (resistencia * (volts - Vout)) / Vout;          // Voltaje a resistencia
  int valor = 500/(RLDR/1000);                                 // Resistencia a lumen
  return valor;
}
