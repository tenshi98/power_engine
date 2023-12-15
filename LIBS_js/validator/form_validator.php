<script>

	// initialize the validator
	var validator = new FormValidator();

	// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
	/*$('form')
		.on('blur', 'input[required], input.optional, select.required', function(){
			validator.checkField.call(validator, this)
		})
		.on('change', 'select.required', function(){
			validator.checkField.call(validator, this)
		})
		.on('keypress', 'input[required][pattern]', function(){
			validator.checkField.call(validator, this)
		})*/
	// bind the validation to the form submit event
	$('form').submit(function(e){
		var submit = true,
			validatorResult = validator.checkAll(this);

		return !!validatorResult.valid;
	});

</script>