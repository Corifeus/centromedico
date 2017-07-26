// src/BackendBundle/Menu/Builder.php
namespace PrincipalBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface {
    use ContainerAwareTrait;
    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root', array(
            'currentClass' => 'active',
            'childrenAttributes' => array(
                'class' => 'nav',
                'id' => 'side-menu'
            ),
        ));
        // Hijo de primer nivel.
        $menu->addChild('Home', array('route' => 'backend_home'));
        // Configuración mediante métodos.
        $menu['Home']->setLabel('<i class="fa fa-dashboard fa-fw"></i> Home');
        $menu['Home']->setExtra('safe_label', true);
        // Hijo de primer nivel.
        $menu->addChild('First entry', array(
            'route' => 'blog_list',
            'routeParameters' => array(
                'id' => 1
            ),
            'label' => '<i class="fa fa-table fa-fw"></i> First entry',
            'extras' => array(
                'safe_label' => true
            )
        ));
        // Hijo de primer nivel, submenu desplegable.
        $menu->addChild('Second entry', array(
            'uri' => '#',
            'attributes' => array(
                'aria-expanded' => 'true'
            ),
            'label' => '<i class="fa fa-user fa-fw"></i> Second entry<span class="fa arrow">',
            'extras' => array(
                'safe_label' => true
            ),
            'childrenAttributes' => array(
                'class' => 'nav nav-second-level',
                'aria-expanded' => 'true'
            )
        ));
        // Añadir hijos a este submenu
        $menu['Second entry']->addChild('Submenu entry', array('uri' => '#test'));
        // ... Añadir más hijos
        return $menu;
    }
}