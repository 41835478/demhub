### Official Documentation
- [Behat](http://docs.behat.org/en/stable/) (on [Git](https://github.com/Behat/Behat))
- [Behat Laravel on Git](https://github.com/laracasts/Behat-Laravel-Extension)
- [Zombie.js](http://zombie.js.org/) (on [Git](https://github.com/assaf/zombie))
- [Selenium2](http://docs.seleniumhq.org/)

#### Start browser testing
- `homestead ssh`
- `selenium-standalone start` OR `selenium-start` (For command breakdown, refer to aliases)
> *Note* that both these commands start the selenium2 server for automated testing within Homestead. `selenium-standalone start` allows for regular browser testing. `selenium-start` allows for headless browser testing (via Selenium)
- In a new terminal window:
- `homestead ssh`
- `cd workspace/demhub`
- `behat`
- Enjoy!

#### Start PHPSpec Unit testing
- Open terminal
- `composer update` this ensures composer is up-to-date
- `vendor/bin/phpspec` lists the content of the phpspec file, ensures it is there
- PHPspec is used to test object functions, this bits that allow browser testing to work essentially
- implementing with PHPspec tutorial https://laracasts.com/lessons/phpspec-is-so-good#
- to create unit tests for an object write '`vendor/bin/phpspec describe`' and the object path
  - for example '`vendor/bin/phpspec describe App/Model/Division`' to create a spec page for the model division
- this action creates a spec file for the object in the '/spec' folder

- to create a spec test function open the new spec file
  - in the example it is 'spec/Models/DivisionSpec.php'
- write a test function in a text editor (preferably atom)
- how to write test functions http://phpspec.readthedocs.org/en/latest/cookbook/matchers.html
  - here is an example spec test function for model division
  `function get_slug_string(){
    $this::find(1);
    $this->slug -> shouldBeString();
  }`
- run the tests with the terminal line `vendor/bin/phpspec run`
- the result should look something like
`100%                                  2
2 specs
2 examples (2 passed)
16ms`
