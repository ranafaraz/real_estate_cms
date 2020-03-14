<style type="text/css" >
    .main-sidebar{
        background-color:#037440 !important;
    }
    .sidebar-menu>li.header{
        background-color:#045a32 !important;
        color: grey !important;
    }
    .sidebar-menu>li :hover{
        background-color:#045a32 !important;
        color: #fff !important;
    }
    .sidebar-menu .treeview-menu
    {
        background-color:#045a32 !important;
        color: #fff !important;
    }
</style>
<aside class="main-sidebar fix" >

    <section class="sidebar">

        <!-- Sidebar user panel -->
        
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= yii::$app->user->identity->image_name ?>" style="height:45px !important" class="img-circle img-fluid" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Real Estate', 'options' => ['class' => 'header']],
                    ['label' => 'DashBoard', 'icon' => 'file-code-o', 'url' => yii::$app->homeUrl],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Property', 'icon' => 'hand-o-right', 'url' => ['/property']],
                    ['label' => 'Plots', 'icon' => 'hand-o-right', 'url' => ['/plot']],
                    ['label' => 'Buy Plot/Property', 'icon' => 'hand-o-right', 'url' => ['/buy-plot']],
                
                    [
                        'label' => 'Services',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Services Type', 'icon' => 'hand-o-right', 'url' => ['/services-type'],],
                            ['label' => 'Services Details', 'icon' => 'hand-o-right', 'url' => ['/services-details'],],
                            ['label' => 'Provide Services', 'icon' => 'hand-o-right', 'url' => ['/provide-services'],],
                    ],
                ],
                [
                        'label' => 'Customer',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Customer', 'icon' => 'hand-o-right', 'url' => ['/customer'],],
                            ['label' => 'Installments', 'icon' => 'hand-o-right', 'url' => ['/installment-payment'],],
                            ['label' => 'Installment Status', 'icon' => 'hand-o-right', 'url' => ['/installment-status'],],
                          
                    ],
                ],
                   [
                        'label' => 'Accounts',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Account nature', 'icon' => 'hand-o-right', 'url' => ['/account-nature'],],
                            ['label' => 'Account Head', 'icon' => 'hand-o-right', 'url' => ['/account-head'],],
                            ['label' => 'Account Payable', 'icon' => 'hand-o-right', 'url' => ['/account-payable'],],
                            ['label' => 'Account Receivable', 'icon' => 'hand-o-right', 'url' => ['/account-recievable'],],
                            ['label' => 'Payment', 'icon' => 'hand-o-right', 'url' => ['/payment'],],
                            ['label' => 'Receive', 'icon' => 'hand-o-right', 'url' => ['/receipt'],],
                          
                    ],

                ],
                [
                        'label' => 'Reports',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Cashbook', 'icon' => 'hand-o-right', 'url' => ['/cashbook'],],
                            ['label' => 'Income Statement', 'icon' => 'hand-o-right', 'url' => ['/income-statement'],],
                            ['label' => 'Payable Reports', 'icon' => 'hand-o-right', 'url' => ['/payable-report'],],
                            ['label' => 'Receivable Reports', 'icon' => 'hand-o-right', 'url' => ['/recievable-report'],],
                    ],
                ],
            ],
        ]
    ) ?>

    </section>

</aside>
