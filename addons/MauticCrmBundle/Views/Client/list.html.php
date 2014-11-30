<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
if ($tmpl == 'index')
    $view->extend('MauticCrmBundle:Client:index.html.php');
?>

<?php if (count($items)): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered category-list" id="categoryTable">
            <thead>
            <tr>
                <th class="visible-md visible-lg col-page-actions pl-20">
                    <div class="checkbox-inline custom-primary">
                        <label class="mb-0 pl-10">
                            <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#categoryTable">
                            <span></span>
                        </label>
                    </div>
                </th>
                <?php

                echo $view->render('MauticCoreBundle:Helper:tableheader.html.php', array(
                    'sessionVar' => 'mapper',
                    'orderBy'    => 'e.title',
                    'text'       => 'mautic.crm.thead.title',
                    'class'      => 'col-category-title',
                    'default'    => true
                ));

                echo $view->render('MauticCoreBundle:Helper:tableheader.html.php', array(
                    'sessionVar' => 'mapper',
                    'orderBy'    => 'e.id',
                    'text'       => 'mautic.crm.thead.id',
                    'class'      => 'visible-md visible-lg col-page-id'
                ));
                ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td class="visible-md visible-lg">
                        <?php
                        echo $view->render('MauticCoreBundle:Helper:list_actions.html.php', array(
                            'item'      => $item,
                            'templateButtons' => array(
                                'edit'      => $permissions[$application.':mapper:edit'],
                                'delete'    => $permissions[$application.':mapper:delete'],
                            ),
                            'routeBase' => 'mapper_client',
                            'langVar'   => 'mapper',
                            'query'      => array(
                                'application' => $application
                            )
                        ));
                        ?>
                    </td>
                    <td>
                        <a href="<?php echo $this->container->get('router')->generate(
                            'mautic_crm_client_objects_index', array(
                            "application"  => $application,
                            "client" => $item->getAlias()
                        )); ?>"><?php echo $item->getTitle(); ?></a>
                    </td>
                    <td class="visible-md visible-lg"><?php echo $item->getId(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="panel-footer">
            <?php echo $view->render('MauticCoreBundle:Helper:pagination.html.php', array(
                "totalItems"      => count($items),
                "page"            => $page,
                "limit"           => $limit,
                "menuLinkId"      => 'mautic_crm_client_index',
                "baseUrl"         => $view['router']->generate('mautic_crm_client_index', array(
                    'application' => $application
                )),
                'sessionVar'      => 'mapper'
            )); ?>
        </div>
    </div>
<?php else: ?>
    <?php echo $view->render('MauticCoreBundle:Helper:noresults.html.php'); ?>
<?php endif; ?>