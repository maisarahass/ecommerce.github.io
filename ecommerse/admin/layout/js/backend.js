$(function () {
    
    
    'use strict';
    
    // هنا بدي اشغل البلقن الخاصة بالسليكت بوكس
    
    $("select").selectBoxIt({
        
       autowidth:false // عشان ميعمليش حجم السلكتاية عقد الكلام لفيها
        
    });
    
    
    
    // هنا الفنكشن الخاصة بالبليس هولدر لبلانبوت لمن تضغط على بالماوس بختفي وبس ترجع بيرجع الكلام
    
    $('[placeholder]').focus(function(){
        
        
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function () {
    
          
            $(this).attr('placeholder', $(this).attr('data-text'))
            
            });
    
    // add astrix == النجمة لبتظهر جمب او تحت الحقول الاجبارية
    
    $('input').each(function (){
        
        if ($(this).attr('required') === 'required')
        {
            $(this).after('<span class="asterisk">*</span>');  
            
         }
    });
    
    
    // الفنكشن الخاصة باظهار الباسورد لمن بعمل هفر على رمز العين
    
    var passFaild = $('.password');
    
    $('.show-pass').hover(function(){
        passFaild.attr('type','text');
        
        
    }, function(){
         passFaild.attr('type','password');
        
    }); 
    
    // هنا رسالة التاكيد عند الضغط على زر الحذف
    
    $('.confirm').click(function(){
        
        return confirm('Are You Sure You Want Delete This User');
    });
    
    // هنا بدي اعمل لمن اضغط على عنوان الكتيجوري يظهرلي باقي التفاصيل من وصف وترتيب وغيرو
    
    $('.cat h3').click(function(){
        
        $(this).next('.full-view').fadeToggle(500);
        
    });
    
    // هان انا بدي اعمل لمن بضغط على الكلاسيك او الفل يعطي كلاس الاكتيف ويشيلو عن الثاني
    $('.option span').click(function(){ // هان قلتلو لمن بضغط كليك على السبان اعمل التالي
         
        $(this).addClass('active').siblings('span').removeClass('active');// روح عالسبان وضفلها كلاس اكتيف وشيل الكلاس عن باقي أشقائها من نفس نوعها
        
           if ($(this).data('view') === 'full')
            {
                $('.cat .full-view').fadeIn();
            } else {
                $('.cat .full-view').fadeOut();            }
        
    });
    
});
 
 
 
 
 
 
 
 
 
 
 
 
 
