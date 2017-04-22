package hello;

import org.joda.time.LocalTime;

public class HelloWorld {
    public static void main(String[] args){
        LocalTime currTime = new LocalTime();
        System.out.println("The current time is: " + currTime);

        Greeter greeter = new Greeter();
        System.out.println(greeter.sayHello());
    }
}
