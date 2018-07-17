#include<LiquidCrystal.h>
LiquidCrystal lcd(13,12,11,10,9,8);
int levelup= 650;
int leveldown= 250;
int probe=0;
int led=1; 
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
  if(s<leveldown){
    lcd.print("Moisture content low");
    digitalWrite(led,HIGH);//to supply power to motor
    delay(1000);
  }
   if(s>levelup){
    lcd.print("Moisture content high");
    digitalWrite(led,LOW);//to cut off power from motor
  }
  lcd.println(s);
  Serial.println(s);
  delay(5000);        // delay in between reads for stability
}
