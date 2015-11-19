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
