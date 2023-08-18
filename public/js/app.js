
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
$( document ).ready(function() {

	$(".next").click(function(){
		if(animating) return false;
		animating = true;

		//alert(exampleFormControlSelect1.value);
		boucleTickets(exampleFormControlSelect1.value);
		calculprix(exampleFormControlSelect1.value);

		current_fs = $(this).parent();
		next_fs = $(this).parent().next();

		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

		//show the next fieldset
		next_fs.show();
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({
					'transform': 'scale('+scale+')',
					'position': 'absolute'
				});
				next_fs.css({'left': left, 'opacity': opacity});
			},
			duration: 800,
			complete: function(){
				current_fs.hide();
				animating = false;
			},
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});

	$(".previous").click(function(){
		if(animating) return false;
		animating = true;

		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();

		//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

		//show the previous fieldset
		previous_fs.show();
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1-now) * 50)+"%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'left': left});
				previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
			},
			duration: 800,
			complete: function(){
				current_fs.hide();
				animating = false;
			},
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});

	$(".submit").click(function(){
		return false;
	})
	function boucleTickets(nbr) {
		if(nbr==0)
		{
			document.getElementById('pasAcc').style.display="flex";
			document.getElementById('place1').style.display="none";
			document.getElementById('place2').style.display="none";
			document.getElementById('place3').style.display="none";
			document.getElementById('place4').style.display="none";
			document.getElementById('place5').style.display="none";
			document.getElementById('place6').style.display="none";
			document.getElementById('place7').style.display="none";
			document.getElementById('place8').style.display="none";
			document.getElementById('place9').style.display="none";
			document.getElementById('place10').style.display="none";
		}
		if(nbr==1)
		{
			document.getElementById('pasAcc').style.display="none";
			document.getElementById('place1').style.display="flex";
			document.getElementById('place2').style.display="none";
			document.getElementById('place3').style.display="none";
			document.getElementById('place4').style.display="none";
			document.getElementById('place5').style.display="none";
			document.getElementById('place6').style.display="none";
			document.getElementById('place7').style.display="none";
			document.getElementById('place8').style.display="none";
			document.getElementById('place9').style.display="none";
			document.getElementById('place10').style.display="none";
		}
		if(nbr==2)
		{
			document.getElementById('pasAcc').style.display="none";
			document.getElementById('place1').style.display="flex";
			document.getElementById('place2').style.display="flex";
			document.getElementById('place3').style.display="none";
			document.getElementById('place4').style.display="none";
			document.getElementById('place5').style.display="none";
			document.getElementById('place6').style.display="none";
			document.getElementById('place7').style.display="none";
			document.getElementById('place8').style.display="none";
			document.getElementById('place9').style.display="none";
			document.getElementById('place10').style.display="none";
		}
		if(nbr==3)
		{
			document.getElementById('pasAcc').style.display="none";
			document.getElementById('place1').style.display="flex";
			document.getElementById('place2').style.display="flex";
			document.getElementById('place3').style.display="flex";
			document.getElementById('place4').style.display="none";
			document.getElementById('place5').style.display="none";
			document.getElementById('place6').style.display="none";
			document.getElementById('place7').style.display="none";
			document.getElementById('place8').style.display="none";
			document.getElementById('place9').style.display="none";
			document.getElementById('place10').style.display="none";
		}
		if(nbr==4)
		{
			document.getElementById('pasAcc').style.display="none";
			document.getElementById('place1').style.display="flex";
			document.getElementById('place2').style.display="flex";
			document.getElementById('place3').style.display="flex";
			document.getElementById('place4').style.display="flex";
			document.getElementById('place5').style.display="none";
			document.getElementById('place6').style.display="none";
			document.getElementById('place7').style.display="none";
			document.getElementById('place8').style.display="none";
			document.getElementById('place9').style.display="none";
			document.getElementById('place10').style.display="none";
		}
		if(nbr==5)
		{
			document.getElementById('pasAcc').style.display="none";
			document.getElementById('place1').style.display="flex";
			document.getElementById('place2').style.display="flex";
			document.getElementById('place3').style.display="flex";
			document.getElementById('place4').style.display="flex";
			document.getElementById('place5').style.display="flex";
			document.getElementById('place6').style.display="none";
			document.getElementById('place7').style.display="none";
			document.getElementById('place8').style.display="none";
			document.getElementById('place9').style.display="none";
			document.getElementById('place10').style.display="none";
		}
		if(nbr==6)
		{
			document.getElementById('pasAcc').style.display="none";
			document.getElementById('place1').style.display="flex";
			document.getElementById('place2').style.display="flex";
			document.getElementById('place3').style.display="flex";
			document.getElementById('place4').style.display="flex";
			document.getElementById('place5').style.display="flex";
			document.getElementById('place6').style.display="flex";
			document.getElementById('place7').style.display="none";
			document.getElementById('place8').style.display="none";
			document.getElementById('place9').style.display="none";
			document.getElementById('place10').style.display="none";
		}
		if(nbr==7)
		{
			document.getElementById('pasAcc').style.display="none";
			document.getElementById('place1').style.display="flex";
			document.getElementById('place2').style.display="flex";
			document.getElementById('place3').style.display="flex";
			document.getElementById('place4').style.display="flex";
			document.getElementById('place5').style.display="flex";
			document.getElementById('place6').style.display="flex";
			document.getElementById('place7').style.display="flex";
			document.getElementById('place8').style.display="none";
			document.getElementById('place9').style.display="none";
			document.getElementById('place10').style.display="none";
		}
		if(nbr==8)
		{
			document.getElementById('pasAcc').style.display="none";
			document.getElementById('place1').style.display="flex";
			document.getElementById('place2').style.display="flex";
			document.getElementById('place3').style.display="flex";
			document.getElementById('place4').style.display="flex";
			document.getElementById('place5').style.display="flex";
			document.getElementById('place6').style.display="flex";
			document.getElementById('place7').style.display="flex";
			document.getElementById('place8').style.display="flex";
			document.getElementById('place9').style.display="none";
			document.getElementById('place10').style.display="none";
		}
		if(nbr==9)
		{
			document.getElementById('pasAcc').style.display="none";
			document.getElementById('place1').style.display="flex";
			document.getElementById('place2').style.display="flex";
			document.getElementById('place3').style.display="flex";
			document.getElementById('place4').style.display="flex";
			document.getElementById('place5').style.display="flex";
			document.getElementById('place6').style.display="flex";
			document.getElementById('place7').style.display="flex";
			document.getElementById('place8').style.display="flex";
			document.getElementById('place9').style.display="flex";
			document.getElementById('place10').style.display="none";
		}
		if(nbr==10)
		{
			document.getElementById('pasAcc').style.display="none";
			document.getElementById('place1').style.display="flex";
			document.getElementById('place2').style.display="flex";
			document.getElementById('place3').style.display="flex";
			document.getElementById('place4').style.display="flex";
			document.getElementById('place5').style.display="flex";
			document.getElementById('place6').style.display="flex";
			document.getElementById('place7').style.display="flex";
			document.getElementById('place8').style.display="flex";
			document.getElementById('place9').style.display="flex";
			document.getElementById('place10').style.display="flex";
		}
	}
	function calculprix(nbr)
	{
		var somme = nbr*8;
		//alert(somme);
		document.getElementById('test').innerHTML=somme;
	}
});
