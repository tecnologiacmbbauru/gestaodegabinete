$(document).ready(function(){
  $('.rg').mask("00.000.000-A");
  $('.cep').mask('00000-000');
  $('.ddd').mask('00');
  $('.cel_phone').mask('00000-0000');
  $('.phone').mask('0000-0000');
  $('.cpf').mask('000.000.000-00');
  $('.cnpj').mask('00.000.000/0000-00');
  $('.ie').mask('000.000.000.000');
	var SPMaskBehavior = function (val) {
	  return val.replace(/\D/g, '').length === 11 ? '000.000.000-00' : '00.000.000/0000-00';
	},
	spOptions = {
	  onKeyPress: function(val, e, field, options) {
		  field.mask(SPMaskBehavior.apply({}, arguments), options);
		}
	};

	$('.cpf').mask(SPMaskBehavior, spOptions)
});

