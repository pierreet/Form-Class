Form
========

**Form** is a library which helps you build and validate forms.


How to use ?
------------


### Create and Display ###

To create and display a new form object you just have to instanciate the class

``` php
<?php

include 'form.class.php';

$form = new Form('unique_id');

echo $form;
```

Result:

``` html
<form method="GET">
	<p>
		<input name="uniqid" type="hidden" value="unique_id" />
	</p>
</form>

```

You can change method and/or action this way

``` php
<?php

include 'form.class.php';

$form = new Form('unique_id');

$form->method('POST');
$form->action('index.php');

echo $form;

```
or:

``` php
<?php

include 'form.class.php';

$form = new Form('unique_id', 'POST');

$form->action('index.php');

echo $form;

```

Result:

``` html
<form method="POST" action="index.php">
	<p>
		<input name="uniqid" type="hidden" value="unique_id" />
	</p>
</form>

```

### Add Field ###

You can add fields by using the method `add('type', 'name')`.
E.g.:
``` php
<?php

include 'form.class.php';

$form = new Form('unique_id', 'POST');

$form->action('index.php');
$form->add('Text', 'name');

echo $form;

```
This will render:
``` html
<form method="POST">
	<p>
		<input name="name" type="text" />
	</p>
	<p>
		<input name="uniqid" type="hidden" value="unique_id" />
	</p>
</form>
```
You can also add a label:
``` php
<?php

include 'form.class.php';

$form = new Form('unique_id', 'POST');

$form->action('index.php');
$form->add('Text', 'name');
	->label('Your name');

echo $form;
```
Result:
``` html
<form method="POST">
	<p>
		<label id="id_name">Your name</label>
		<input for="id_name" name="name" type="text" />
	</p>
	<p>
		<input name="uniqid" type="hidden" value="unique_id" />
	</p>
</form>
```
Allowed types are:
* single line text : Text
* multi lines text : Textarea
* password         : Password 
* hidden field     : Hidden
* validate button  : Submit
* button           : Button
* radio button     : Radio
* select option    : Select
* checkbox         : Checkbox
* file upload      : File
* e-mail address   : Email
* date / time      : Date
* captcha          : Captcha


### Single Line Text ###

This will render an `<input type="text" />` field.

### Multi Lines Text ###

This will render an `<textarea></textarea>` field. 
You can specify the size with `rows()` and `cols()` methods : `$form->add('Textarea', 'comment')->rows(15)->cols(74);`.

### Validate Button ###

This will render an `<input type="submit" />` button.

### Button ###

This will render an `<input type="button" />` button.

### Radio button ###

This will render `<input type="field" />` field.
You can specify the list of choices with the `choices()` method: `$form->add('Radio', 'sex')->choices(array('m' => 'Male','f' => 'Female'));`

### Select Option ###

This will render an `<select> <optgroup> <option>` fields.
As for the radio button you have the `choices()` method : 
``` php
<?php
$form->add('Select', 'country')
         ->choices(array(
           'Europe' => array(
             'fr' => 'France',
             'de' => 'Germany'
           ),
           'Asia' => array(
             'cn' => 'China',
             'jp' => 'Japan'
           )
         ));
```

### Checkbox ###

This will render an `<input type="checkbox" />` field.


### File Upload ###

This will render an `<input type="file" />` field.
You can specify the maximum size and the extensions authorized like this:
``` php
<?php
$form->add('File', 'avatar')
         ->max_size(4096)  //=> 4kb
         ->extensions(array('jpg', 'gif', 'png'));
```

### Email Address ###

This will render an `<input type="text" />` field. When the form will be submitted the field won't be validated if the address entered is not a valid one.

### Date / Time ###

This will render an `<input type="text" />` field. As for the e-mail field the form won't be validated if the date isn't correct.
You need to specify the format of the date with the method `format`: `$form->add('Date', 'date')->format('mm/dd/yyyy');`
Supported formats are the following:
* dd
* mm
* yy
* yyyy
* HH
* MM
* SS

### Captcha ###

This will render an `<input type="text" />` field with an image. To validate this field user will have to copy the text which is in the image into the field.




Other methods
-----------------

There is other methods that exists for all the field:
*required(bool)     : Specify if the field is required to validate the form (default true)
*autocomplete(bool) : Display the autocomplete HTML property (default false)
*maxlength(int)     : Specify the maximum length that can have a text field
*minlength(int)     : Specify the minimum length that can have a text field
*javascript(string) : Allow to add some javascript code (ie: onclick, ...) to the field (actually you can add anything you want, eg: other html attributes)


There is other methods for the form object:

### Filling ###
You can fill the form with the method `bound`:
``` php
<?php
$form->->bound($_POST); // <= allow to fill the form after error on validation
```

### Validation ###
To check if the form is valid you have the method : `bool is_valid(array)`. This will return true if all fields are correctly filled with the data in the array.
To retrieve fields values the method is : `get_cleaned_data(array | string [, string [, ...]])`. This will return the value of the listed fields.
E.g.:
``` php
<?php
if($form->is_valid($_POST)){

	list($name, $country) = $form->get_cleaned_data('name', 'country');
	echo 'Your name is: '.$name;

}
```



Credits
-------

 Original author: [Savageman](http://www.siteduzero.com/membres-294-395.html)


License
-------

This class is licensed under the LGPL public license
