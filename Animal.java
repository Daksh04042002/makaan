// Base class Animal
public abstract class Animal {
    public abstract void makeSound();
}

// Derived class Dog
public class Dog extends Animal {
    @Override
    public void makeSound() {
        System.out.println("The dog barks.");
    }
}

// Derived class Cat
public class Cat extends Animal {
    @Override
    public void makeSound() {
        System.out.println("The cat meows.");
    }
}

// Main class to demonstrate polymorphism
public class Main {
    public static void main(String[] args) {
        // Create objects of Dog and Cat
        Dog myDog = new Dog();
        Cat myCat = new Cat();

        // Create an Animal reference
        Animal animalRef = null;

        // Demonstrate polymorphism
        animalRef = myDog;
        animalRef.makeSound();  // Output: The dog barks.

        animalRef = myCat;
        animalRef.makeSound();  // Output: The cat meows.

        // Alternatively, use an array or list to store objects of different classes
        Animal[] animals = new Animal[] { myDog, myCat };

        for (Animal animal : animals) {
            animal.makeSound();
        }
    }
}