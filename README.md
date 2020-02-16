# chmod-resolver-task

Installation (needs PHP 7.3+ and composer, see https://getcomposer.org)
```
./resolve install
```

Expected usage:
```
./resolve [MODE] [WHO] [OPERATION], e.g.: 

./resolve 755 u x      # checks if 755 mode allows user to execute
./resolve 001 g r      # checks if 001 mode allows group to read
./resolve 225 o w      # checks if 255 mode allows others to write
```

Running tests:
```
./resolve test
```

Task: to fix the tests

Correct answer: https://github.com/kugaudo/chmod-resolver
