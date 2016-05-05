(function ($) {

	$.fn.slider = function (settings) {

		var s = $.extend({
			data:'',			// Data provide from WP_Query
			rlBtns:true,		// Right and Left Buttons
			pointersBtns:true,		// Pointers Buttons
			thumbBtns:true,		// Thumbnails Buttons
			autoPlay:true,		// Auto movement through items
			time:3,
			showTitle:true,
			showExcerpt:true,
			showImage:true,
			showTime:true,
			showCats:true,
			showReadMore:false,
		}, settings);

		var timer;

		return this.each(function(){

			this.appendChild(createSlider(s.data,this.className));

			$(document).on('ready',function(){

				autoPlay();

				$('.Thumb').on('click',function(){
					movement($(this).data('pos'));
					clearInterval(timer);
					autoPlay();
				});

				$('.Pointer').on('click',function(){
					movement($(this).data('pos'));
					clearInterval(timer);
					autoPlay();
				});

				$('.RBtn').on('click',function(){
					movement($(this).attr('data-nextmove'));
					clearInterval(timer);
					autoPlay();
				});

				$('.LBtn').on('click',function(){
					movement($(this).attr('data-nextmove'));
					clearInterval(timer);
					autoPlay();
				});

			});

		});

		function nextMovement(){

			var nextS = $('div[class="Slide SlideCurrent"]');
			var p = parseInt(nextS.data('pos'));

			if (p==s.data.length-1){
				p = 0;
			} else {
				p = p + 1;
			}

			return p;

		}

		function autoPlay(){

			if (s.autoPlay===true) {
				timer = setInterval(function(){

					p = nextMovement();
					movement(p);

				},s.time*1000);
			}

		}

		function createSlider(d,Slide){

			var inner = document.createElement('div');
			inner.className = Slide+'Inner';

			var nav = document.createElement('div');
			nav.className = 'Nav';

			var rlbtns = document.createElement('div');
			rlbtns.className = 'RLBtns';

			var rbtn = document.createElement('div');
			rbtn.className = 'RBtn';
			rbtn.setAttribute('data-nextmove','1');

			var lbtn = document.createElement('div');
			lbtn.className = 'LBtn';
			lbtn.setAttribute('data-nextmove',d.length-1);

			rlbtns.appendChild(lbtn);
			rlbtns.appendChild(rbtn);

			var pointersBtns = document.createElement('ul');
			pointersBtns.className = 'Pointers';


			for (var i = 0; i < d.length; i++) {

				//Creación del SLIDE
				var slide = document.createElement('div');
				slide.id = 'Slide-'+i;
				slide.className = (i==0)?'Slide SlideCurrent':'Slide';
				slide.setAttribute('data-pos',i);

				var info = document.createElement('div');
				info.className = 'SlideInfo';

				// Creación de la Imagen con Link
				var aimg = document.createElement('a');
				aimg.href = d[i].link;
				aimg.innerHTML = d[i].img;

				// Creación del Título con Link
				var title = document.createElement('span');
				title.className = 'SlideTitle';

				var atitle = document.createElement('a');
				atitle.href = d[i].link;
				atitle.appendChild(document.createTextNode(d[i].title));
				title.appendChild(atitle);

				// Creación del Sumario
				var excerpt = document.createElement('span');
				excerpt.className = 'SlideExcerpt';
				excerpt.appendChild(document.createTextNode(d[i].excerpt));

				// Creación de la Fecha de Publicación
				var time = document.createElement('span');
				time.className = 'SlideTime';
				time.appendChild(document.createTextNode(d[i].time));

				// Creación de Categoría de la Publicación
				var cats = document.createElement('span');
				cats.className = 'SlideCategory';
				cats.appendChild(document.createTextNode(d[i].cats[0].name));

				// Creación del Botón "Leer más"
				var readmore = document.createElement('a');
				readmore.className = 'SlideReadMore';
				readmore.href = d[i].link;
				readmore.appendChild(document.createTextNode('Leer más'));


				if (s.showImage===true) slide.appendChild(aimg);
				if (s.showCats===true) info.appendChild(cats);
				if (s.showTime===true) info.appendChild(time);
				if (s.showTitle===true) info.appendChild(title);
				if (s.showExcerpt===true) info.appendChild(excerpt);
				if (s.showReadMore===true) info.appendChild(readmore);

				slide.appendChild(info);

				inner.appendChild(slide);

				var thumb = document.createElement('div');
				thumb.id = 'Thumb-'+i;
				thumb.className = (i==0)?'Thumb ThumbCurrent':'Thumb';
				thumb.setAttribute('data-pos',i);

				thumb.innerHTML = d[i].thumb;

				if (s.thumbBtns===true) nav.appendChild(thumb);

				var pointer = document.createElement('li');
				pointer.id = "Pointer-"+i;
				pointer.className = (i==0)?'Pointer PointerCurrent':'Pointer';
				pointer.setAttribute('data-pos',i);

				pointersBtns.appendChild(pointer);

			};

			inner.appendChild(nav);
			if (s.rlBtns===true) inner.appendChild(rlbtns);
			if (s.pointersBtns===true) inner.appendChild(pointersBtns);

			return inner;

		}

		function movement(p){

			var nextS = $('div[id="Slide-'+p+'"]');
			var currentS = $('div[class="Slide SlideCurrent"]');

			var nextT = $('div[id="Thumb-'+p+'"]');
			var currentT = $('div[class="Thumb ThumbCurrent"]');

			var nextP = $('li[id="Pointer-'+p+'"]');
			var currentP = $('li[class="Pointer PointerCurrent"]');
			//console.log(currentP);

			if (!nextS.hasClass('SlideCurrent')){

				currentS.animate({opacity:0,},150,function() {
					$(this).removeClass('SlideCurrent');
				});

				currentT.animate({opacity:.6,},150,function() {
					$(this).removeClass('ThumbCurrent');
				});

				currentP.animate({opacity:1,},150,function() {
					$(this).removeClass('PointerCurrent');
				});

				nextS.animate({opacity:1},150,function(){
					$(this).addClass('SlideCurrent');
				});

				nextT.animate({opacity:1},150,function(){
					$(this).addClass('ThumbCurrent');
				});

				nextP.animate({opacity:1},150,function(){
					$(this).addClass('PointerCurrent');
				});

				if (s.rlBtns===true){

					pr = parseInt(p) + 1;
					pl = parseInt(p) - 1;

					if (pr > s.data.length-1) pr = 0;
					if (pl < 0) pl = s.data.length-1;

					$('.RLBtns .RBtn').attr('data-nextmove',pr);
					$('.RLBtns .LBtn').attr('data-nextmove',pl);

				}

			}

		}

	}

}(jQuery));