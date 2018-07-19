#include<LiquidCrystal.h>
LiquidCrystal lcd(13,12,11,10,9,8);
int levelup= 1021;
int leveldown= 1019;
int probe=0;
int led=2; 
void setup() {
  // initialize serial communication at 9600 bits per second:
  Serial.begin(9600);
  lcd.begin(16,2);
  pinMode(led,OUTPUT);
  digitalWrite(led,LOW);
  lcd.print("Soil Display Meter");
  delay(1000);
  lcd.clear();
}

// the loop routine runs over and over again forever:
void loop() {
  // read the input on analog pin 0:
  lcd.clear();
  int s= analogRead(probe);
  Serial.println(s);
  int o=Serial.read();
  if(o==1){
    digitalWrite(led,HIGH);//to supply power to motor
    //Serial.println(1);
    delay(1000);
  }
  else if(o==0){
   digitalWrite(led,LOW);//to cut off power from motor
  //Serial.println(0); 
  }
  else if(s<leveldown){
    lcd.print("Moisture low:");
    digitalWrite(led,HIGH);//to supply power to motor
    Serial.println(1);
    delay(1000);
  }
   else if(s>levelup){
    lcd.print("Moisture high:");
    digitalWrite(led,LOW);//to cut off power from motor
    Serial.println(0);
  }
  else{
     digitalWrite(led,HIGH);//to supply power to motor
    Serial.println(1);
    delay(1000);
    }
  lcd.println(s);
  delay(5000);        // delay in between reads for stability
  lcd.clear();
}
