# Chat project

## Table of Contents  
[Plans](#plans)  
[Fix tips](#fix)  

<a name="headers"/>
### Plans to implement:

* user authentication and authorization
* chat on the pusher api or web hooks
* and other functions that bring the application closer to the functionality of the messenger

<a name="fix"/>
### Some fix tips:

* if confirm raises the following exception: "foreach argument must be array, string given", add the following to the app/vendor/yiisoft/yii2/db/BaseActiveRecord, method getOldPrimaryKey: 'if (!is_array($keys)) {$keys = array($keys);}'

