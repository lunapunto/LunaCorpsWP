/*
* Función onResize()
* Llamada al inicio y cuando la venta se vuelve a ajustar
*/
function onResize(){
   hwindow = $(window).height();
   wwindow = $(window).width();
   /*
   * Helper para clases .full
   * Asigna el alto de tamaño de la ventana
   */
   if(isset('.full')){
     $('.full').height(hwindow);
   }
   /*
   * Helper para clases .min_full
   * El tamaño mínimo del elemento será el alto de la ventana
   */
   if(isset('.min_full')){
     $('.min_full').css('min-height', hwindow+'px');
   }
}

$(document).ready(function(){
  onResize();

  /* Instancía las variables principales */
  ajaxurl = $('#ajaxurl').val();
  dir = $('#dir').val();

})

/*
* On window resize ()
*/
$(window).resize(function(){
  onResize();
})

/*
* onLoad()
* Trigger in footer.php
*/
function onLoad(){
};

/* Window on load */
$(window).on('load', function(){
  $('#loader').fadeOut(500);
  $('body').addClass('loaded');
  onLoad();
});
