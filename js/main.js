$ (document).ready(function(){
	
	$('#mobile-menu-active').meanmenu({
		meanScreenWidth:"991",
		meanMenuContainer:'.mobile-menu'
	});
	
	
	//slider-active 
	
	  $('.slider-active').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,

    });
		 //testimonial-active 
	  $('.testimonial-active').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        autoplay: true,

    });
		  $('.brand-active').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true,
		responsive:[
		{
			breakpoint:991,
			settings:{
				slidesToShow:4,
				slidesToScroll:1
			}
		},
		{
			breakpoint:767,
			settings:{
				slidesToShow:3,
				slidesToScroll:2
			}
		},
		{
			breakpoint:576,
			settings:{
				slidesToShow:2,
				slidesToScroll:1
			}
		},
		]

    });
	//counter js active
	$('.counter').counterUp({
        delay: 10,
        time: 10000
    });
})