# You own a zoo! 

Your zoo is close to bankruptcy. Until the zoo is profitable, your rich brother said that he would pay the operating cost if his son can tour the zoo every day. His son, Timmy, gets very sad if the animals are not happy or have escaped. If Timmy isn’t happy, your brother isn’t happy. If your brother isn’t happy, he doesn’t pay.

You have another brother who is an animal activist. He believes no animals should ever be in a zoo. He wants you to close the zoo. Every night he sneaks in and moves all of the animals and takes their food.

## Vagrant Instructions
on the command line:
```
vagrant up
vagratn ssh
cd /zoo-problem
php testZoo.php
```
## Assignment Instructions
1. Implement the ZooKeeper interface in a new class and complete all the required methods. Call the class “Keeper” and put the file in the root of the project.
2. Extend the abstract class Animal three times. Once for each habitat type. Put these class files in the “animals” folder.
3. In the file testZoo.php, include (require_once) all files you created at the top of the file.
4. Add an instance of each of you animals to the `$animals` array
5. Replace `$zooKeeper = new stdClass();` with `$zooKeeper = new Keeper();`
6. In all of your new classes, complete the bodies of the abstract and interface defined methods.
7. To satisfy Timmy, look for concrete methods in the Animal class that need to be overridden in each child classes.  
