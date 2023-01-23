<html>

<head>
  <title>Trains Form</title>

  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
</head>

<body class="ml-24 bg-slate-200">
  <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">

    <div class="space-y-6 pt-8 sm:space-y-5 sm:pt-10">
    <div class="flex flex-row">
        <div>
        <h3 class="text-3xl font-bold text-amber-900 leading-6 mb-7">Train Details...</h3>
        </div>
        <div>
        <a href="train_info_list.php" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">List</a>
        </div>
        <!-- <p class="mt-1 max-w-2xl text-sm text-gray-500">Use a permanent address where you can receive mail.</p> -->
      </div>
      </div>

      <?php
      if (isset($_GET['insert']) && $_GET['insert'] == 'failure') {
      ?>

        <div class="rounded-md bg-red-50 p-4">
          <div class="flex">
            <div class="flex-shrink-0">
              <!-- Heroicon name: mini/x-circle -->
              <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
              </svg>
            </div>
            <div class="ml-3">
              <h3 class="text-sm font-medium text-red-800">This train already exist</h3>
              <div class="mt-2 text-sm text-red-700">
                <ul role="list" class="list-disc space-y-1 pl-5">
                  <li>Please add another record</li>
                  <!-- <li>Your password must include at least one pro wrestling finishing move</li> -->
                </ul>
              </div>
            </div>
          </div>
        </div>

      <?php
      }
      ?>

      <?php
      require_once 'db.php';

      if ($_POST) {
        // print_r($_POST);
        //  exit;
        $trainName = $_POST['train_name'];
        $trainNo = $_POST['train_no'];
        $totalSeat = $_POST['total_seat'];
        $trainType = $_POST['train_type'];
        $creAt = date("Y-m-d H:i:s");
        $trainId=$_POST['train_id'];
       

        if($trainId=='')
        {
        // echo $creAt;
        $sql = "SELECT COUNT(id) as count from train_info WHERE train_name='$trainName'";
        $res = mysqli_query($conn, $sql);
        $arrRes = mysqli_fetch_assoc($res);
        // echo $arrRes['count'];

        if ($arrRes['count'] == 0) {
          $sql = "INSERT INTO train_info (train_name, train_no, total_seat, train_type, created_at) VALUES ('$trainName','$trainNo','$totalSeat','$trainType','$creAt')";
          if (mysqli_query($conn, $sql)) { ?>
            <script>
              location.href = "train_info_list.php?insert=success";
            </script>
          <?php } else {
            echo "Error inserting..." . "<br>" . mysqli_error($conn);
          }
        } else { ?>
          <script>
            location.href = "train_info.php?insert=failure";
          </script>
      <?php }
        }
        else
        {
          $sql="UPDATE train_info SET  train_no='$trainNo', total_seat='$totalSeat',train_type='$trainType' WHERE id=$trainId";
          if(mysqli_query($conn,$sql))
          {?>
          <script>
            location.href="train_info_list.php?update=success";
          </script>
            
          <?php 
          }
        }
      } 


      //edit case
      $tName = $tNo = $tseat = $tType = $id= '';
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM train_info WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        $query = mysqli_fetch_assoc($res);
        // print_r($query);

        $tName = $query['train_name'];
        $tNo = $query['train_no'];
        $tseat = $query['total_seat'];
        $tType = $query['train_type'];
        // echo $tName;
        // exit;
      }
      ?>
      <form action="train_info.php" method="POST" class="space-y-8 divide-y divide-gray-200">
        <input type="hidden" name="train_id" value="<?php echo $id ;?>">
        <div class="space-y-6 sm:space-y-5">
          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="train_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Train Name</label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <input type="text" name="train_name" <?php if ($id != '') echo 'readonly' ?> id="train_name" value="<?php echo $tName; ?>" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="train_no" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Train No</label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <input type="text" name="train_no" id="train_no" value="<?php echo $tNo; ?>" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
            </div>
          </div>
          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="total_seat" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Number of Seats</label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <select id="total_seat" name="total_seat" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">


                <?php
                for ($i = 1; $i <= 10; $i++) {
                ?>
                  <option value="<?php echo $i ?>"<?php if($tseat==$i) echo "selected"; ?> ><?php echo $i ?></option>
                <?php
                }
                ?>

              </select>
            </div>
          </div>


          <div class="pt-6 sm:pt-5">
            <div role="group" aria-labelledby="label-notifications">
              <div class="sm:grid sm:grid-cols-3 sm:items-baseline sm:gap-4">
                <div>
                  <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700" id="label-notifications">Train Type</div>
                </div>
                <div class="sm:col-span-1">
                  <div class="max-w-lg">
                    <!-- <p class="text-sm text-gray-500">These are delivered via SMS to your mobile phone.</p> -->
                    <div class="mt-4 flex flex-row space-x-6">
                      <div class="flex items-center">
                        <input id="push-passenger" name="train_type" type="radio" <?php if($tType == 0) echo "checked"; ?> value="0" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="push-passenger" class="ml-3 block text-sm font-medium text-gray-700">Passenger</label>
                      </div>
                      <div class="flex items-center">
                        <input id="push-express" name="train_type" type="radio" <?php if($tType == 1) echo "checked"; ?> value="1" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="push-express" class="ml-3 block text-sm font-medium text-gray-700">Express</label>
                      </div>
                      <!-- <div class="flex items-center">
                        <input id="push-nothing" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="push-nothing" class="ml-3 block text-sm font-medium text-gray-700">No push notifications</label>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="space-y-6 divide-y divide-gray-200  sm:space-y-5 sm:pt-10">
    </div>
  </div>
  </div>

  <div class="pt-5">
    <div class="flex justify-center">
      <button type="button" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
      <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
    </div>
  </div>
  </form>
</body>

</html>