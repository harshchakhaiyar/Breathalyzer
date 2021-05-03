#include "mbed.h"
#include "uLCD_4DGL.h"
#include "beer.h"
#define sample_freq 65535.0

uLCD_4DGL uLCD(p9, p10, p11);
DigitalIn pb(p20);
AnalogIn alcohol(p16);
PwmOut mySpeaker(p21);

Ticker sampletick;

int j = 0;

void audio_sample(){
    mySpeaker = data[j]/255.0; //data is from beer_sound.h
    j++;
    if (j>=NUM_ELEMENTS){
        j=0;
        sampletick.detach();    
    }
}

// end of audio for beer noise

double timer_and_sample() {
    double alcohol_sum = 0.0;
    // Display countdown timer
    uLCD.color(RED);
    uLCD.text_height(6);
    uLCD.text_width(6);
    for (int i = 10; i > 0; i--) {
        uLCD.filled_rectangle(0, 0, 128, 128, BLACK);
        uLCD.locate(1,1);
        uLCD.printf("%d", i);
        alcohol_sum += alcohol.read();      
        printf("%0.2f\n", alcohol.read());
        if (i != 1) wait(1); 
    }
    uLCD.filled_rectangle(0, 0, 128, 128, BLACK);   
    return alcohol_sum / 10.0;
}    

void display_welcome() {
    uLCD.color(WHITE);
    uLCD.text_width(2);
    uLCD.text_height(2);
    uLCD.locate(1,2);
    uLCD.printf("Welcome!\n");
    uLCD.text_width(1);
    uLCD.text_height(1);
    uLCD.locate(1,8);
    uLCD.printf("Press the button\n to start");   
}

int main() {
    
    //mySpeaker.PlaySong(note,duration);
    mySpeaker.period(1.0/250000.0);
    sampletick.attach(&audio_sample, 1.0/sample_freq);
    wait(2.0);
    pb.mode(PullUp);
    display_welcome();
    double sensor_reading;
    int target = !pb, display_percentage;
    while (1) {
        if (pb == target) {
            target = !target;
            sensor_reading = timer_and_sample();
            display_percentage = sensor_reading*100;
            uLCD.text_width(1);
            uLCD.text_height(1);
            uLCD.locate(3,2);
            uLCD.color(WHITE);
            uLCD.printf("DrinkUp"); 
            uLCD.locate(3,4);
            uLCD.printf("Score");
            uLCD.locate(3,6);
            uLCD.printf("%d", display_percentage);
            uLCD.locate(3,8);
            if (display_percentage < 50) {
                uLCD.printf("You are sober!");
            } else {
                uLCD.printf("You drunk?");
            }
            
        }   
    }
}