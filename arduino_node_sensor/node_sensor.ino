// Biblioteca para conversão
#include <Arduino.h>

// Biblioteca para ESP8266 NodeMCU
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
WiFiClient client;

// Biblioteca para Sensor DHT22
#include "DHT.h"
#define DHTTYPE DHT22     // tipo de sensor utilizado
#define DHTPIN 13         // pino D7 no NodeMCU
DHT dht(DHTPIN, DHTTYPE);

// Configurar o Servidor Web e o ID do Sensor
String ipServidor = "192.168.244.100";
String idSensor = "testeArdu";

void setup() {
  Serial.begin(115200);
  while (!Serial); // wait for serial port to connect // Serial.setDebugOutput(true);

  // Configurar Conexão, SSID e Senha do Wifi
  WiFi.mode(WIFI_STA);
  WiFi.begin("HSPDA", "woowoow00w00");
  //WiFi.begin("IFBA_labcvt", "ifbalabcvt");

  Serial.print("\nWait for WiFi... ");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }

  dht.begin();
}

void loop() {
  //Inicio Leitura Sensor DHT22
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  if (isnan(h) || isnan(t)) {
    Serial.println("Falha para ler o sensor DHT!");
    return;
  }
  Serial.print("Humidade: ");
  Serial.print(h);
  Serial.print(" %\t");
  Serial.print("Temperatura: ");
  Serial.print(t);
  Serial.println(" *C ");
  //Fim Leitura Sensor DHT22

  // Inicio do teste do Wifi
  if ((WiFi.status() == WL_CONNECTED)) {
    Serial.println("Conectado na Rede!");
    Serial.print("Endereço IP do Sensor: ");
    Serial.println(WiFi.localIP());
  } else {
    Serial.println("Sem conexão wifi.");
  }
  // Inicio do teste do Wifi

  // Inicio Transmissão PHP
  String temp, humi;
  temp =  String(t, 2);
  humi =  String(h, 2);
  String pagina = String ("http://" + ipServidor + "/dht22.php?idsensor="
                          + idSensor + "&" + "temp=" + temp + "&" + "humi=" + humi);
  if ((WiFi.status() == WL_CONNECTED)) {

    HTTPClient http;

    Serial.print("[HTTP] begin...\n");
    http.begin(pagina); //HTTP

    Serial.print("[HTTP] GET...\n");

    int httpCode = http.GET();

    // httpCode será negativo se tiver erro
    if (httpCode > 0) {
      Serial.printf("[HTTP] GET... code: %d\n", httpCode);

      // file found at server
      if (httpCode == HTTP_CODE_OK) {
        String payload = http.getString();
        Serial.println(payload);
      }
    } else {
      Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
    }

    http.end();
  }

  delay(60000); //Delay de 60 segundos
}
