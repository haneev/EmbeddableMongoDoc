<?php
return array(
    array(
        'ean' => '2',
        'owner_ref' => MongoDbRef::create('users', new MongoId("54203e1968235bfd0e8b4594")),
        'product_ref' => MongoDbRef::create('products', new MongoId("54203e1968235bfd0e8b4597")),
    ),
    array(
        'ean' => '1',
        'owner_ref' => MongoDbRef::create('users', new MongoId("54203e1968235bfd0e8b4595")),
        'product_ref' => MongoDbRef::create('products', new MongoId("54203e1968235bfd0e8b4596")),
    )
);