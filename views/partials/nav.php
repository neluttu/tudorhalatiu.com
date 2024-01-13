<nav class="bg-gray-800">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="w-8 h-8" src="https://oop.devserver.ro/images/mark.svg" alt="Your Company">
          </div>
          <div class="hidden md:block">
            <div class="flex items-baseline ml-10 space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="<?= \Core\Session::getLang(); ?>/" class="<?= urlIs('/') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium"><?= \Core\Lang::text('nav.home') ?></a>
                <a href="<?= \Core\Session::getLang(); ?>/about" class="<?= urlIs('/about') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= \Core\Lang::text('nav.about') ?></a>
                <? if($_SESSION['user'] ?? false) : ?> <a href="<?= \Core\Session::getLang(); ?>/notes" class="<?= urlIs('/notes') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= \Core\Lang::text('nav.notes') ?></a> <? endif; ?>
                <a href="<?= \Core\Session::getLang(); ?>/contact" class="<?= urlIs('/contact') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= \Core\Lang::text('nav.contact') ?></a>
                <a href="<?= \Core\Session::getLang(); ?>/products" class="<?= urlIs('/products') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"><?= \Core\Lang::text('nav.products') ?></a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="flex items-center ml-4 md:ml-6">
            
            <a href="<?= \Core\Session::getLang(); ?>/cart" class="flex items-center justify-center gap-3 text-white" title="<?php echo Core\ShoppingCart::getCartPrice(); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"  viewBox="0 0 24 24" stroke-width="1.5" stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                </svg>
                <?php echo Core\ShoppingCart::getTotalItemsInCart(); ?>
            </a>

            <!-- Profile dropdown -->
            <div class="relative flex gap-5 ml-3">
              <div>
                <button type="button" class="relative flex items-center max-w-xs text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="sr-only">Open user menu</span>
                  <? if($_SESSION['user'] ?? false) : ?>
                    <a href="<?= \Core\Session::getLang(); ?>/account"><img class="w-8 h-8 rounded-full" src="https://avatars.githubusercontent.com/u/25511379?v=4" alt=""></a>
                    <? else : ?>
                        <a href="<?= \Core\Session::getLang(); ?>/register" class="pr-3 text-white">Register</a>
                        <a href="<?= \Core\Session::getLang(); ?>/login" class="text-white">Login</a>
                    <? endif; ?>        
                </button>
              </div>
              <div class="relative ml-3">
                  <? if($_SESSION['user'] ?? false) : ?>
                      <form method="post" action="<?= \Core\Session::getLang(); ?>/logout">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="text-white">
                            Logout
                        </button>
                      </form>
                  <? endif; ?>        
              </div>
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>