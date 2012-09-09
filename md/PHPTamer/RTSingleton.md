Master Singleton Class
======================

#### Via the factory
	$l = RTSingleton::factory('Translate');

#### Directs call
	$view = RTSingleton::Template();

#### Class Alias
	RTSingleton::alias(string $className, string $alias);

	RTSingleton::alias('Template', 'V');

#### Aliased call _RTSingleton has an S alias by default_  
	$view = S::V();

#### Set Object  _Not available in version 0.0.1_
	RTSingleton::set(object $class [, string $alias = NULL ] );

    RTSingleton::set(new Aura\View\Template(), 'View');

#### Actually:
     RTSingleton::set(require __dir__ . '/../libs/composer/vendor/Aura/View/scripts/instance.php','V');


#### No need for global variables
	S::V()->var = 'Master RTSingleton Class';


#### Use original class or alias or switch back and forth
	echo RTSingleton::Template()->fetch(__dir__ .'/gui/layout.php');
	echo S::V()->fetch(__dir__ .'/gui/otherlayout.php');

#### See all the registered classes
	print_r(S::getClasses());

<a class="embed" href="https://api.bitbucket.org/1.0/repositories/robotamer/phptamer/src/tip/RTSingleton.php?embed=t"></a>
https://api.bitbucket.org/1.0/repositories/robotamer/phptamer/src/tip/RTSingleton.php



