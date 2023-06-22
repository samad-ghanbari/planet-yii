<a id="<?= "comp-".$model['abbr']; ?>" href="<?= Yii::$app->request->baseUrl.'/sitex/exchange?id='.$model['id']; ?>" >
  <div id="<?= "comp-div-".$model['abbr']; ?>" class="hvr-grow comp-div" style="width:200px; height: 250px; background-color:gainsboro; margin:5px;">
    <h3 class="text-center" style="color:mediumvioletred;"><?= $model['abbr']; ?></h3>
    <hr />
    <h3 class="text-center"><?= $model['name']; ?></h3>
    <hr />
    <h5 class="text-center"><?= $model['address']; ?></h5>
  </div>
</a>
