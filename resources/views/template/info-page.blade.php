<x-template.layout>
	<x-slot:seo_description>		
		{{{ isset($infoPage->seo_description) ? $infoPage->seo_description : '' }}}		
	</x-slot>
	<x-slot:title>
		{{{ isset($infoPage->title) ? $infoPage->title : "Информационная страница пользователя" }}}
	</x-slot>
	<x-slot:id>
		{{ $id }}
	</x-slot>	
	<div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          <h2>{{{ isset($infoPage->header) ? $infoPage->header : 'Заголовок'}}}</h2>
          <div class="clr"></div>                   
          <p>{!! isset($infoPage->description) ? $infoPage->description : 'Авторское описание страницы' !!}</p>
        </div>        
      </div>
      <div class="sidebar">
        <div class="gadget">
          <!-- <h2 class="star"><span>Sidebar</span> Menu</h2>
          <div class="clr"></div>
          <ul class="sb_menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">TemplateInfo</a></li>
            <li><a href="#">Style Demo</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Archives</a></li>
          </ul> -->
        </div>
        <div class="gadget">
<!--           <h2 class="star"><span>Sponsors</span></h2>
          <div class="clr"></div>
          <ul class="ex_menu">
            <li><a href="#">Lorem ipsum dolor</a><br />
              Donec libero. Suspendisse bibendum</li>
            <li><a href="#">Donec mattis</a><br />
              Phasellus suscipit, leo a pharetra</li>
            <li><a href="#">Dui pede condimentum</a><br />
              Tellus eleifend magna eget</li>
            <li><a href="#">Condimentum lorem</a><br />
              Curabitur vel urna in tristique</li>
            <li><a href="#">Fringilla velit magna</a><br />
              Cras id urna orbi tincidunt orci ac</li>
            <li><a href="#">Suspendisse bibendum</a><br />
              purus nec placerat bibendum</li>
          </ul>
 -->        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
            <!--    <h2><span>Image Gallery</span></h2>
 <a href="#"><img src="{{ asset('storage/template/images/pix1.jpg') }}" width="58" height="58" alt="" /></a> <a href="#"><img src="{{ asset('storage/template/images/pix2.jpg') }}" width="58" height="58" alt="" /></a> <a href="#"><img src="{{ asset('storage/template/images/pix3.jpg') }}" width="58" height="58" alt="" /></a> <a href="#"><img src="{{ asset('storage/template/images/pix4.jpg') }}" width="58" height="58" alt="" /></a> <a href="#"><img src="{{ asset('storage/template/images/pix5.jpg') }}" width="58" height="58" alt="" /></a> <a href="#"><img src="{{ asset('storage/template/images/pix6.jpg') }}" width="58" height="58" alt="" /></a> </div> -->
      <div class="col c2">
<!--         <h2><span>Lorem Ipsum</span></h2>
        <p>Lorem ipsum dolor<br />
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam</a>, lectus turpis varius lorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam.</p> -->
      </div>
      <div class="col c3">
<!--         <h2><span>Contact</span></h2>
        <p>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue.</p>
        <p><a href="#">support@yoursite.com</a></p>
        <p>+1 (123) 444-5677<br />
          +1 (123) 444-5678</p>
        <p>Address: 123 TemplateAccess Rd1</p> -->
      </div>
      <div class="clr"></div>
    </div>
  </div>
	
</x-template.layout>