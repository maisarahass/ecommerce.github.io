<?php
        ob_start();

        session_start();

        $pageTitle='Categories Page';

        if (isset($_SESSION['username']))

        {

         include 'init.php';
          $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
            

           if ($do == 'Manage'){
           $sort = 'Asc'; // عملنا متغير اسمو سورت واعطينا قيمة افتراضية هي الترتيب التصاعدي   
           $sort_array = array('Asc' , 'Desc'); // هنا عملنا مصفوفة فيها القيمتين لرح يمكن للمستخدم يرتب عن طريقهم وهم تصاعدي او تنازلي
               // هنا احنا حكنالو اذا الصفحة حاملة متغير اسمو سورت وهذا المتغير قيمتو من القيم الموجودة في داخل مصفوفة السورت
            if(isset($_GET['$sort']) && in_array($_GET['$sort'] , $sort_array ))
            {
                $sort  = $_GET['$sort']; // فإن قيمة السورت هي قيمة القيمة لجاية من الصفحة
            }

           $stmt = $con->prepare("SELECT * FROM categories ORDER BY ordering $sort");  // طبعا عشان اجلب الاقسام من الداتا استخدمت سكلت لجميع العناصر بالنجمة
               
           $stmt->execute();  // قلتلو نفذ جملة السليكت
      
           $cats = $stmt->fetchAll();// وهان بقلو بعد متحضر البيانات حطهم بمتغير كاتز  ?>
            <h1 class="text-center">Manage Categories</h1>
             <div class="container categoris">
                 <div class="panel panel-default">
                    <div class="panel-heading"> <i class="fa fa-edit"> </i> Manege Categoris
                       <div class="option pull-right">
                           <i class="fa fa-sort"></i>  Ordaring : [
                           <a class="<?php if($sort == 'Asc'){ echo 'active'; } ?>" href="?$sort=Asc">Asc</a> |
                           <a class="<?php if($sort == 'Desc'){ echo 'active'; } ?>" href="?$sort=Desc">Desc</a>]
                           <i class="fa fa-eye"></i>  View : [
                           <span  class="active" data-view="full">Full</span> |
                           <span  data-view="classic">Classic</span>]
                        </div>
                     </div>
                       <div class="panel-body"> <?php
                        
                       foreach($cats as $cat) // حطينا البيانات لجاية من الكاتس بفريابول اسمو كات وكلو جوا فورش ايش عشان التكرار لكل الاسماء تعوت الكاتيكيورز
                       {
                           echo "<div class='cat'>";
                           echo "<div class='hidden-btn'>";
                             echo "<a href='categories.php?do=Edit&catid=". $cat['ID'] ."' class='btn btn-xs btn-primary'><i class='fa fa-edit'>Edit</i></a>";
                             echo "<a href='categories.php?do=Delete&catid=". $cat['ID'] ."' class='btn btn-xs btn-danger confirm'><i class='fa fa-close'>Delete</i></a>";
                           echo "</div>" ;  
                           echo '<h3>' . $cat['Name'] . '</h3>';
                           echo "<div class='full-view'>";
                               echo "<p>" ; if($cat['Description']==''){echo 'this descreption is empty';} else {echo $cat['Description'];} echo "</p>";  // عملنا الشرط عشان لو مكانش في وصف للمنتج يقلك مفيش وصف ولو كان في يطبعهولك                    
                               if ($cat['Visibilty']==1){echo '<span class="visibal"><i class="fa fa-eye"></i> Hidden</span>';}
                               if ($cat['Allow_Comment']==1){echo '<span class="comment"><i class="fa fa-close"></i> Comment Desible</span>';}
                               if ($cat['Allow_Ads']==1){echo '<span class="adsvetise"><i class="fa fa-close"></i> Ads Desible</span>';}
                           echo "</div>";
                           echo  "</div>";
                           echo  "<hr>";
                       }
                        
                        ?>
                        </div>
                 </div>
                     <a href="categories.php?do=Add" class="btn btn-primary addcat"><i class="fa fa-plus"></i>Add New Categoeirs<a>
                 
                 
             </div>     


          


           <?php

           }elseif($do == 'Add'){ ?>


                      <h1 class="text-center">Add New Category</h1>

                      <div class="container">
                          <form class="form-horizontal" action="?do=Insert" method="POST">
                              <!--Start name faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">Name</label>
                               <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" autocomplete="off"  placeholder="Name of the Category" />

                                </div>
                             </div>
                              <!--End name faild -->
                                 <!--Start description faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">Description</label>
                               <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" placeholder="The Description Of Categorys"/>

                                </div>
                             </div>
                              <!--End description faild -->
                                 <!--Start Ordaring faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">Orrdaring</label>
                               <div class="col-sm-10">
                                <input type="text" name="orrder" class="form-control"  placeholder="The Number To Ordar Catogers"/>

                                </div>
                             </div>
                              <!--End Ordaring faild -->
                                 <!--Start Full visabil faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">visible</label>
                               <div class="col-sm-10">
                                <div>
                                 <input type="radio" id="visb yes" name="visibility" value="0" checked />
                                <label for="visb yes">Yes</label>     
                                </div>
                                <div >
                                 <input type="radio" id="visb no" name="visibility" value="1"/>
                                <label for="visb no">No</label>     
                                </div>   

                                </div>
                             </div>
                              <!--End visabil faild -->
                              <!--Start Alloe-commant faild -->
                                 <div class="form-group form-group-lg">
                                   <label class="col-sm-2 control-label">Commenting</label>
                                   <div class="col-sm-10">
                                    <div>
                                     <input type="radio" id="comm yes" name="comment" value="0" checked />
                                    <label for="comm yes">Yes</label>     
                                    </div>
                                    <div >
                                     <input type="radio" id="comm no" name="comment" value="1"/>
                                    <label for="comm no">No</label>     
                                    </div>   

                                    </div>
                                 </div>
                              <!--End Alloe-commant faild -->
                              
                               <!--Start Alloe-Ads faild -->
                                 <div class="form-group form-group-lg">
                                   <label class="col-sm-2 control-label">Allow Ads</label>
                                   <div class="col-sm-10">
                                    <div>
                                     <input id="ads-yes" type="radio"  name="ads" value="0" checked />
                                    <label for="ads-yes">Yes</label>     
                                    </div>
                                    <div >
                                     <input id="ads-no" type="radio"  name="ads" value="1" />
                                    <label for="ads-no">No</label>     
                                    </div>   

                                    </div>
                                 </div>
                              <!--End Alloe-Ads faild -->
                                 <!--Start Save faild -->
                             <div class="form-group form-group-lg">
                               <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" value="Add Categories" class="btn btn-primary btn-lg" />

                                </div>
                             </div>
                              <!--End Save faild -->
                          </form>

                        </div>
        


               
              <?php
           }elseif ($do == 'Insert'){
                       if($_SERVER['REQUEST_METHOD'] == 'POST'){
                       echo "<h1 class='text-center'>Add Catogeris</h1>";
                       echo "<div class='container'>"; // حطينها بدف الكونتينر تاع البوتستراب عشان نستفيد من خصائص البوتستراب في الفلديشن

                        // لو لقا جاي من الفورم بدي روح يجيب القيم من الانبوت المدخلات في الفورم


                         $name = $_POST['name'];
                         $desc = $_POST['description'];
                         $order = $_POST['orrder'];
                         $visible = $_POST['visibility'];
                         $comment = $_POST['comment'];
                         $ads = $_POST['ads'];


                        // هنا بدنا نعمل الفاليديشن الخاص بحقول الادخال يعني نبرمجهم برمجة بلغة الphp
                        // مهم جدا انك تعرف انو برمجة الفاليديشن لازم تكون قبل الاتصال بقاعدة البيانات
                        $fromerrore = array(); // هنا عملنا مصفوفة بدنا نحط كل رسائل الايرور فيها
                        if(empty($name)){
                                    echo "<div class='container'>";
                          $themsg = '<div class="alert alert-danger"> The Name Fiald cant be empty</div>';

                          redirecthome($themsg,'back' , 6); // لو خليتها هيك حتعملك ايرور لانو اصلا الانسيرت ملوش صفحة جاي منها
                          echo "</div>";
                        }

                        foreach($fromerrore as $error)
                        {
                            echo '<div class="alert alert-danger">' .  $error . '</div>' ;  // استخدمنا ديف الاليرت من البوتستراب عشان نظهر رسالة خطأ بطريقة جميلة
                        }

                        if(empty($fromerrore)) // هنا انا قلتلو لو كانت مصفوفة الاخطاء خالية من اي خطا توكل عالله وفوت بمرحلة التعديل لكن لو في خطا اظهرو ومتعملش تعديل
                        {

                            // اول حاجة متل مقلنا بدي اشيك عالاسم المدخل هل موجود فعليا بالداتا ولا لا
                            $check = checkitem("Name" , "categories" ,$name);
                            if($check === 1)
                            {

                                   echo "<div class='container'>";
                          $themsg = '<div class="alert alert-danger">this Categores is exeite</div>';

                          redirecthome($themsg,'back'); // لو خليتها هيك حتعملك ايرور لانو اصلا الانسيرت ملوش صفحة جاي منها
                          echo "</div>";

                            }

                            else
                                    {
                                    //هالقيت بعد ميجيبهم بدو يروح يحفظهم بالداتا
                                    $stmt = $con->prepare("INSERT INTO categories(Name , Description  , Ordering  , Visibilty , Allow_Comment 
                                    , Allow_Ads )
                                     VALUES(:zname ,:zdesc ,:zorder ,:zvisi , :zcomment , :zads)");// استخدمت اسماء عادية من راسي ملهاش علاقة بحاجة وبعدين بربطهم بالمتغيرات لاستخدمتهن فوق
                                                        // ولاحظ عملنا ريجسترستيت  1 لانو بدنا لمن الادمن يضيف يعضو يكون عطول مفعل لكن لو العضو عمل حساب ميكونش مفعل الا لمن الادمن يوافق علي
                                     $stmt->execute(array(
                                         'zname'    =>  $name,
                                         'zdesc'    =>  $desc,
                                         'zorder'   =>  $order,
                                         'zvisi'    =>  $visible,
                                         'zcomment' =>  $comment,
                                         'zads'     =>  $ads
                                     ));


                                   $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Recored Inserted </div>'; //وهنا قلنالو رجعلي عدد الاسطر لصار عليها تغيير في الدتا
                                         redirecthome($themsg , 'back');
                                }

                        }


                    }else{

                          echo "<div class='container'>";
                          $themsg = '<div class="alert alert-danger">sorry you dont login</div>';

                          redirecthome($themsg , 'back'); // لو خليتها هيك حتعملك ايرور لانو اصلا الانسيرت ملوش صفحة جاي منها
                          echo "</div>";
                    }

                    echo "</div>"; 

            }elseif ($do == 'Edit'){
               
                          $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0; // دالة اف المختصرة نفس فعالية اف لتحت
                 // بعد متجيب رقم اليوزر روح على قاعدة اليانات واعمل سلكت لجميع عناصر المستخدم 
        $stmt = $con->prepare("SELECT * 
                    FROM categories 
                    WHERE ID = ? ");
                    $stmt->execute(array($catid));
                    $cat = $stmt->fetch(); //هنا بروح بيجلب البيانات وبرجعهم بمصفوفة
                    $count = $stmt->rowCount(); // هنا احنا عملنا فحص وتاكدنا من وجود البيانات بالداتا بيز
                    if ($stmt->rowCount() > 0) //اذا صار تغيير اظهر فورمة التعديل
                    {
                   
        /*            
    
     if(isset($_GET['userid']) && is_numeric($_GET['userid'])) // لو القت لجيلك حامل يوزر ايدي وبشرط يكون رقم
     {
         echo intval($_GET['userid']); // اطبع قيمة الانتجر
     } else {
         echo 0;
     }

   */
                          ?>
                          <h1 class="text-center"> Update The Category</h1>

                      <div class="container">
                          <form class="form-horizontal" action="?do=Update" method="POST">
                               <input name="catid" type="hidden" value="<?php echo $catid ?>"/>
                              <!--Start name faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">Name</label>
                               <div class="col-sm-10">
                                <input type="text" name="name" class="form-control"  placeholder="Name of the Category" value="<?php echo $cat['Name'] ?>" />

                                </div>
                             </div>
                              <!--End name faild -->
                                 <!--Start description faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">Description</label>
                               <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" placeholder="The Description Of Categorys" value="<?php echo $cat['Description'] ?>" />

                                </div>
                             </div>
                              <!--End description faild -->
                                 <!--Start Ordaring faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">Orrdaring</label>
                               <div class="col-sm-10">
                                <input type="text" name="orrder" class="form-control"  placeholder="The Number To Ordar Catogers"
                                    value="<?php echo $cat['Ordering'] ?>"  />

                                </div>
                             </div>
                              <!--End Ordaring faild -->
                                 <!--Start Full visabil faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">visible</label>
                               <div class="col-sm-10">
                                <div>
                                 <input type="radio" id="visb yes" name="visibility" value="0" <?php if($cat['Visibilty']==0){echo 'checked';} ?>/>
                                <label for="visb yes">Yes</label>     
                                </div>
                                <div>
                                 <input type="radio" id="visb no" name="visibility" value="1" <?php if($cat['Visibilty']==1){echo 'checked';} ?>/>
                                <label for="visb no">No</label>     
                                </div>   

                                </div>
                             </div>
                              <!--End visabil faild -->
                              <!--Start Alloe-commant faild -->
                                 <div class="form-group form-group-lg">
                                   <label class="col-sm-2 control-label">Commenting</label>
                                   <div class="col-sm-10">
                                    <div>
                                     <input type="radio" id="comm yes" name="comment" value="0" <?php if($cat['Allow_Comment']==0){echo 'checked';} ?>/>
                                    <label for="comm yes">Yes</label>     
                                    </div>
                                    <div >
                                     <input type="radio" id="comm no" name="comment" value="1" <?php if($cat['Allow_Comment']==1){echo 'checked';} ?>/>
                                    <label for="comm no">No</label>     
                                    </div>   

                                    </div>
                                 </div>
                              <!--End Alloe-commant faild -->
                              
                               <!--Start Alloe-Ads faild -->
                                 <div class="form-group form-group-lg">
                                   <label class="col-sm-2 control-label">Allow Ads</label>
                                   <div class="col-sm-10">
                                    <div>
                                     <input id="ads-yes" type="radio"  name="ads" value="0"  <?php if($cat['Allow_Ads']==0){echo 'checked';} ?>/>
                                    <label for="ads-yes">Yes</label>     
                                    </div>
                                    <div >
                                     <input id="ads-no" type="radio"  name="ads" value="1" <?php if($cat['Allow_Ads']==1){echo 'checked';} ?> />
                                    <label for="ads-no">No</label>     
                                    </div>   

                                    </div>
                                 </div>
                              <!--End Alloe-Ads faild -->
                                 <!--Start Save faild -->
                             <div class="form-group form-group-lg">
                               <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" value="Save Edit" class="btn btn-primary btn-lg" />

                                </div>
                             </div>
                              <!--End Save faild -->
                          </form>

                        </div>
        
        
                         <?php

                            } else { // لو لا محدثش تغيير

                                  echo "<div class='container'>";
                                  $themsg = '<div class="alert alert-danger">Theres Is not such ID</div>';

                                  redirecthome($themsg); // لو خليتها هيك حتعملك ايرور لانو اصلا الانسيرت ملوش صفحة جاي منها
                                  echo "</div>";

                            }

            } elseif ($do == 'Update') {
               
                         if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        echo "<h1 class='text-center'>Update Categories</h1>";
                        echo "<div class='container'>"; // حطينها بدف الكونتينر تاع البوتستراب عشان نستفيد من خصائص البوتستراب في الفلديشن

                            // لو لقا جاي من الفورم بدي روح يجيب القيم من الانبوت المدخلات في الفورم

                             $id        =  $_POST['catid'];
                             $name      =  $_POST['name'];
                             $desc      =  $_POST['description'];
                             $order     =  $_POST['orrder'];
                             $visibl    =  $_POST['visibility'];
                             $comment   =  $_POST['comment'];
                             $ads       =  $_POST['ads'];

                           
                                //هالقيت بعد ميجيبهم بدو يروح يحطهم بالداتا بدل القيم القديمة يعني يعمل تحديث
                            $stmt = $con->prepare("UPDATE categories 
                                                  SET Name = ? ,
                                                  Description = ?,
                                                  Ordering = ?, 
                                                  Visibilty = ?,
                                                  Allow_Comment =?,
                                                  Allow_Ads = ?
                                                  WHERE ID = ? "); // اعمل تحديث للقيم في قاعدة البيانات بناء على القيم الجديدة
                             
                            $stmt->execute(array($name , $desc , $order , $visibl , $comment , $ads , $id)); // هنا انا اعطيتو القيم الجديدة
                            $themsg =  "<div class='alert alert-success'>" . $stmt->rowCount() . 'Recored Updated </div>'; //وهنا قلنالو رجعلي عدد الاسطر لصار عليها تغيير في الدتا
                                 redirecthome($themsg , 'back');

                            




                            }else{

                            echo "<div class='container'>";
                              $themsg = '<div class="alert alert-danger">sorry you dont login</div>';

                              redirecthome($themsg); // لو خليتها هيك حتعملك ايرور لانو اصلا الانسيرت ملوش صفحة جاي منها
                              echo "</div>";


                        }

                        echo "</div>";

            }elseif($do == 'Delete'){
               
                  echo "<h1 class='text-center'>Delete Categories</h1>";
                  echo "<div class='container'>"; // حطينها بدف الكونتينر تاع البوتستراب عشان نستفيد من خصائص البوتستراب في الفلديشن
            
        

                   $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0; //دالة اف المختصرة ت
                         // بعد متجيب رقم اليوزر روح على قاعدة اليانات واعمل سلكت لجميع عناصر المستخدم 
                            /*
                           $stmt = $con->prepare("SELECT * 
                            FROM users 
                            WHERE UserID = ?
                            LIMIT 1");
                            $stmt->execute(array( $userid));
                            $count = $stmt->rowCount(); // هنا احنا عملنا فحص وتاكدنا من وجود البيانات بالداتا بيز
                            */
                           $chek = checkitem('ID','categories',$catid); // استعضنا عن الطريقة لفوق بفنكشن التشيك لانها بتوفر وقت وكود
                           
                            if ($chek > 0) //اذا صار تغيير اظهر فورمة التعديل
                            {

                                  $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid"); // هنا قلتلو احذف القسم من جدول الاقسام عندما يكون 
                                   // رقم القسم نفس الرقم لجيني من فوق في البوست
                                  $stmt->bindparam(":zid" ,$catid );  // طبعا هنا انت عرفت الداتا بالمتغير لاسمو زدايدي

                                  $stmt->execute(); // هالقيت نفذ يمعلم
                                  $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Recored Deleted </div>'; 
                                   redirecthome($themsg , 'back');
                                
                            }else
                            {
                                
                                echo "<div class='container'>";
                               $themsg = '<div class="alert alert-danger">This user not found</div>';
              
                              redirecthome($themsg); // لو خليتها هيك حتعملك ايرور لانو اصلا الانسيرت ملوش صفحة جاي منها
                               echo "</div>";
            
                            }
        
                  echo '</div>';


           }

             include $tpl . 'footer.php';
        } else
        {
            header('Location: index.php');
            exit();
        }

        ob_end_flush();
?>