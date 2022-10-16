<?
$this->title = 'Шаблоны дл статей';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $this->title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $this->title ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-9 connectedSortable">
                    <div class="row">
                        <?= $this->render('autor-default')?>
                    </div>
                </section>
                <section class="col-lg-3 connectedSortable">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>