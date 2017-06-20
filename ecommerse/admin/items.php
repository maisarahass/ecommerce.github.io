<?php 

   /*

    ============= Items Name
    ==================================================
    
    */
        ob_start();

        session_start();

        $pageTitle='Items';

        if (isset($_SESSION['username']))

        {

         include 'init.php';
          $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

           if ($do == 'Manage'){// 
                   
                  $stmt = $con->prepare("SELECT items.*,categories.Name AS category,users.UserName FROM items
                                            INNER JOIN categories ON categories.ID = items.Cat_ID
                                            INNER JOIN users on users.UserID = items.Members_ID"); // هان حكتلو روح جبلي كل البيانات من جدول اليوزر بس بشرط ميكونش القروب ايدي 1 لانو الواحد خاص بالادمن وانا مش عاوز اجيب بيانات الادمن
                  $stmt->execute();  

                   $items = $stmt->fetchAll();// وهان بقلو بعد متحضر البيانات حطهم بمتغير اسموروز

                ?>

                         <h1 class="text-center">Manege Items</h1>

                           <div class="container">
                               <div class="table-responsive">
                                  <table class="table maneg-tab text-center table-bordered">
                                    <tr>
                                        <td>#ID</td>
                                        <td>Name</td>
                                        <td>Descreptipn </td>
                                        <td>Price</td>
                                        <td>Add_Date</td>
                                        <td>Category</td>
                                        <td>UserName</td>
                                        <td>Controles</td>
                                   </tr>
                                      <?php
                                      foreach($items as $item){
                                          echo "<tr>";
                                             echo "<td>" .$item['ItemID'] . "</td>";
                                             echo "<td>" .$item['Name'] . "</td>";
                                             echo "<td>" .$item['Descreptipn'] . "</td>";
                                             echo "<td>" .$item['Price'] . "</td>";
                                             echo "<td>" .$item['Add_Date'] . "</td>";
                                             echo "<td>" .$item['category'] . "</td>";
                                             echo "<td>" .$item['UserName'] . "</td>";
                                             echo "<td> <a href='items.php?do=Edit&itemid=". $item['ItemID'] ."' class='btn btn-success'><i                 class='fa fa-edit'></i>Edit</a>
                                                        <a href='items.php?do=Delete&itemid=".$item['ItemID']."' class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
                                            echo "</td>";
                                          echo "</tr>";
                                      }
                                       ?>

                                   </table>  

                               </div>
                              <a href="items.php?do=Add" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Add New items</a>
                           </div>

                            <?php


           }elseif($do == 'Add'){ ?>
               <h1 class="text-center">Add New Items</h1>

                      <div class="container">
                          <form class="form-horizontal" action="?do=Insert" method="POST">
                              <!--Start name faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">Name</label>
                               <div class="col-sm-10">
                                <input type="text" name="name" class="form-control"  placeholder="Name of the Items" required="required"/>

                                </div>
                             </div>
                              <!--End name faild -->
                                 <!--Start description faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">Description</label>
                               <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" placeholder="The Description Of Categorys" required="required" />

                                </div>
                             </div>
                              <!--End description faild -->
                                 <!--Start price faild -->
                             <div class="form-group form-group-lg">
                               <label class="col-sm-2 control-label">Price</label>
                               <div class="col-sm-10">
                                <input type="text" name="price" class="form-control"  placeholder="Price Of The Item" required="required" />

                                </div>
                             </div>
                              <!--End price faild -->
                               <!--start Counrty Mead  faild -->
                               <div class="form-group form-group-lg">
                               
                               <label class="col-sm-2 control-label">Country Of Mead</label>
                               <div class="col-sm-10">
                                <input type="text" name="country-mead" class="form-control"  placeholder="Contry Mead Of The Item" required="required"/>

                                 </div>
                                   </div>
                                 <!--End Counrty Mead  faild -->
                              
                                <!--start Stutas Mead  faild -->
                               <div class="form-group form-group-lg">
                               
                               <label class="col-sm-2 control-label">Stutas</label>
                               <div class="col-sm-10">
                                   <select name="stutas">
                                       <option value="0">select The Stutas</option>
                                       <option value="1">New</option>
                                       <option value="2">Modern</option>
                                       <option value="3">Old</option>
                                       <option value="4">Very Old</option>
                                   
                                   </select>

                                 </div>
                                   </div>
                                 <!--End Stetus Mead  faild -->
                                      
                                <!--start Chooes Members faild -->
                               <div class="form-group form-group-lg">
                               
                               <label class="col-sm-2 control-label">Member</label>
                               <div class="col-sm-10">
                                   <select name="member">
                                       <option value="0">Choose The Member</option>
                                       <?php
                                          $stmt = $con->prepare("SELECT * FROM users"); // حكتلو اعمل سلكت عجدول اليوزر وهتلى كل الحقول
                                          $stmt->execute(); // هان حكتلو نفذ السلكت
                                          $users =$stmt->fetchAll(); // هان جملة الفتش بتجلب كل العناصر وبتخزنهم بمتغير اسمو يوزرس طبعا المتغير من اختياري
                                           foreach($users as $user) // هان اعملت لوب لانو حيجيب اكثر من مستخدم وقلتلو حطهم بمتغير اسمويوزر
                                           {
                                               echo "<option value= '". $user['UserID'] ."'> ". $user['UserName'] ."</option>";
                                           }
                                       ?>
                                   </select>

                                 </div>
                                   </div>
                                 <!--End Chooes Members faild -->
                                  <!--start Chooes Categoties faild -->
                               <div class="form-group form-group-lg">
                               
                               <label class="col-sm-2 control-label">Categories</label>
                               <div class="col-sm-10">
                                   <select name="Category">
                                       <option value="0">Choose The Categories</option>
                                       <?php
                                          $stmt = $con->prepare("SELECT * FROM categories"); // حكتلو اعمل سلكت عجدول اليوزر وهتلى كل الحقول
                                          $stmt->execute(); // هان حكتلو نفذ السلكت
                                          $cats =$stmt->fetchAll(); // هان جملة الفتش بتجلب كل العناصر وبتخزنهم بمتغير اسمو كاتس طبعا المتغير من اختياري
                                           foreach($cats as $cat) // هان اعملت لوب لانو حيجيب اكثر من مستخدم وقلتلو حطهم بمتغير اسموكاتر
                                           {
                                               echo "<option value= '". $cat['ID'] ."'> ". $cat['Name'] ."</option>";
                                           }
                                       ?>
                                   </select>

                                 </div>
                                   </div>
                                 <!--End Chooes Categoties faild -->
                                 
                                 <!--Start Save faild -->
                             <div class="form-group form-group-lg">
                               <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" value="Add Items" class="btn btn-primary btn-lg" />

                                </div>
                             </div>
                              <!--End Save faild -->
                          </form>

                        </div>
              <?php



           }elseif ($do == 'Insert'){
                         if($_SERVER['REQUEST_METHOD'] == 'POST'){
                       echo "<h1 class='text-center'>Add New Items</h1>";
                       echo "<div class='container'>"; // حطينها بدف الكونتينر تاع البوتستراب عشان نستفيد من خصائص البوتستراب في الفلديشن

                        // لو لقا جاي من الفورم بدي روح يجيب القيم من الانبوت المدخلات في الفورم


                         $name    = $_POST['name'];
                         $desc    = $_POST['description'];
                         $price   = $_POST['price'];
                         $country = $_POST['country-mead'];
                         $stutas  = $_POST['stutas'];
                         $member  = $_POST['member'];
                         $Category  = $_POST['Category'];

                        // هنا بدنا نعمل الفاليديشن الخاص بحقول الادخال يعني نبرمجهم برمجة بلغة الphp
                        // مهم جدا انك تعرف انو برمجة الفاليديشن لازم تكون قبل الاتصال بقاعدة البيانات
                        $fromerrore = array(); // هنا عملنا مصفوفة بدنا نحط كل رسائل الايرور فيها
                        if(empty($name)){
                            $fromerrore[] ='this name cant be empty'; 
                        }
                        if(empty($desc)){
                            $fromerrore[] ='this description cant be empty';
                        }
                        if(empty($price)){
                            $fromerrore[] ='this price cant be empty';
                        }
                        if(empty($country)){
                            $fromerrore[] ='this country cant be empty';
                        }
                         if($stutas == 0){
                            $fromerrore[] ='this stutas cant be empty';
                        }
                    
                         if($member == 0){
                            $fromerrore[] ='this member cant be empty';
                        }
    
                         if($Category == 0){
                            $fromerrore[] ='this Category cant be empty';
                        }
                            
                        foreach($fromerrore as $error)
                        {
                            echo '<div class="alert alert-danger">' .  $error . '</div>' ;
                        }

                        if(empty($fromerrore)) // هنا انا قلتلو لو كانت مصفوفة الاخطاء خالية من اي خطا توكل عالله وفوت بمرحلة التعديل لكن لو في خطا اظهرو ومتعملش تعديل
                        {

                              
                                    //هالقيت بعد ميجيبهم بدو يروح يحفظهم بالداتا
                                    $stmt = $con->prepare("INSERT INTO items(Name , Descreptipn , Price , Add_Date , Country_Maid , Statues ,Cat_ID , Members_ID)
                                                          VALUES(:zname ,:zdesc ,:zprice ,now() , :zcountry , 
                                                          :zStatues , :zcat , :zmember)");// استخدمت اسماء عادية من راسي ملهاش علاقة بحاجة وبعدين بربطهم بالمتغيرات لاستخدمتهن فوق
                                                        // ولاحظ عملنا ريجسترستيت  1 لانو بدنا لمن الادمن يضيف يعضو يكون عطول مفعل لكن لو العضو عمل حساب ميكونش مفعل الا لمن الادمن يوافق علي
                                     $stmt->execute(array(
                                         'zname'    =>  $name,
                                         'zdesc'    =>  $desc,
                                         'zprice'   =>  $price,
                                         'zcountry' =>  $country,
                                         'zStatues' =>  $stutas,
                                         'zcat'     =>  $Category,
                                         'zmember'  =>  $member
                                     ));


                                   $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Recored Inserted </div>'; //وهنا قلنالو رجعلي عدد الاسطر لصار عليها تغيير في الدتا
                                         redirecthome($themsg , 'back');
                                

                                }


                            }else{

                                  echo "<div class='container'>";
                                  $themsg = '<div class="alert alert-danger">sorry you dont login</div>';

                                  redirecthome($themsg); // لو خليتها هيك حتعملك ايرور لانو اصلا الانسيرت ملوش صفحة جاي منها
                                  echo "</div>";
                            }

                            echo "</div>"; 

            }elseif ($do == 'Edit'){

            } elseif ($do == 'Update') {

            }elseif($do == 'Delete'){


           }elseif($do == 'ِApprove'){
           }

             include $tpl . 'footer.php';
        } else
        {
            header('Location: index.php');
            exit();
        }

        ob_end_flush();
?>