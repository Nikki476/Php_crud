<html>

<head>
  <title>ROUTE</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
</head>

<body class="ml-24 bg-slate-200">
  <?php
  include 'operations.php';
  $dbObj = new dbOperation();
  $trainList = $dbObj->getTable('train_info', false, false, false);

  if ($_POST) {
    // print_r($_POST);
    // exit;
    $rid = $_POST['id'];
    $source = $_POST['source'];
    $source_code = $_POST['source_code'];
    $destination = $_POST['dest'];
    $destination_code = $_POST['dest_code'];
    $train_id = $_POST['train_id'];
    $departure_time = date("H:i", strtotime($_POST['departure_time']));
    $arrival_time = date("H:i", strtotime($_POST['arrival_time']));
    $service_days = "";
    foreach ($_POST['days'] as $key => $value) {
      $service_days .= $value . ",";
    }
    if ($rid == '') {
      $fields = 'source,source_code,destination,destination_code,train_id,departure_time,arrival_time,service_days';
      $values = "'$source','$source_code','$destination','$destination_code',$train_id,'$departure_time', '$arrival_time','$service_days'";
      $dbObj = new dbOperation();
      $res = $dbObj->insert('train_routes', $fields, $values);
      if ($res) { ?>
        <script>
          location.href = "route_list.php?insert=success"
        </script>
      <?php }
    } else {
      $fieldValue = "source='$source',source_code='$source_code',destination='$destination',destination_code='$destination_code',train_id='$train_id',departure_time='$departure_time',arrival_time='$arrival_time',service_days='$service_days'";
      $dbObj = new dbOperation();
      $result = $dbObj->update('train_routes', $fieldValue, 'id', $rid);
      if ($result) { ?>
        <script>
          location.href = "route_list.php?update=success"
        </script>
  <?php }
    }
  }

  $rid = $source = $source_code = $destination = $destination_code = $train_id = $departure_time = $arrival_time = $arr_serviceDays = '';

  if (isset($_GET['id'])) {
    $rid = $_GET['id'];
    $dbObj = new dbOperation();
    $res = $dbObj->getRow('train_routes',array('id'), array($rid));

    $source = $res['source'];
    $source_code = $res['source_code'];
    $destination = $res['destination'];
    $destination_code = $res['destination_code'];
    $train_id = $res['train_id'];
    $departure_time = $res['departure_time'];
    $arrival_time = $res['arrival_time'];
    //$service_days = $res['service_days'];
    // print_r($service_days);
    // exit;
    $arr_serviceDays = explode(',', $res['service_days']);
  }

  ?>
  <form action="route.php" method="POST" class="space-y-8 divide-y divide-gray-200">
    <input type="hidden" name="id" value="<?php echo $rid; ?>">
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">

      <div class="space-y-6 pt-8 sm:space-y-5 sm:pt-10">

        <div>
          <h3 class="text-3xl font-bold text-amber-900 leading-6 mb-7">Route</h3>
          <a href="route_list.php" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">List</a>
          <!-- <p class="mt-1 max-w-2xl text-sm text-gray-500">Use a permanent address where you can receive mail.</p> -->
        </div>
        <div class="space-y-6 sm:space-y-5">
          <div class="flex flex-row">
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
              <label for="source" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Source</label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                <input type="text" name="source" value="<?php echo $source; ?>" id="source" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
              </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5 px-32">
              <label for="source_code" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 pr-7">Source Code</label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                <input type="text" name="source_code" id="source_code" value="<?php echo $source_code; ?>" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
              </div>
            </div>
          </div>
          <div class="flex flex-row">
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
              <label for="destination" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Destination</label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                <input type="text" name="dest" id="dest" value="<?php echo $destination; ?>" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
              </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5 px-32">
              <label for="destination_code" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Destination Code</label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                <input type="text" name="dest_code" id="dest_code" value="<?php echo $destination_code; ?>" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
              </div>
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="train_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Train Name</label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <select id="train_id" name="train_id" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
                <?php foreach ($trainList as $key => $tl) { ?>
                  <option value="<?php echo $tl['id'] ?>" <?php if ($train_id == $tl['id']) echo "selected"; ?>><?php echo $tl['train_name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="departure_time" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Departure Time</label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <input type="time" name="departure_time" id="departure_time" value="<?php echo $departure_time; ?>" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="arrival_time" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Arrival Time</label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <input type="time" name="arrival_time" id="arrival_time" value="<?php echo $arrival_time; ?>" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
            </div>
          </div>
          <div role="group" aria-labelledby="service_days">
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
              <div>
                <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700" id="days">Days of Service</div>
              </div>
              <div class="mt-4 sm:col-span-2 sm:mt-0">
                <div class="max-w-lg space-y-4 grid grid-cols-3 gap-6">
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="Sunday" name="days[0]" type="checkbox" value="SUN" <?php if($rid!='') if (in_array('SUN', $arr_serviceDays)) echo "checked" ; ?> class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="Sunday" class="font-medium text-gray-700">Sunday</label>
                      <!-- <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="Monday" name="days[1]" type="checkbox" value="MON" <?php  if($rid!='') if (in_array('MON', $arr_serviceDays)) echo "checked"; ?> class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="Monday" class="font-medium text-gray-700">Monday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate applies for a job.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="Tuesday" name="days[2]" type="checkbox" value="TUE" <?php  if($rid!='') if (in_array('TUE', $arr_serviceDays)) echo "checked"; ?> class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="Tuesday" class="font-medium text-gray-700">Tuesday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="Wednesday" name="days[3]" type="checkbox" value="WED" <?php  if($rid!='') if (in_array('WED', $arr_serviceDays)) echo "checked"; ?> class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="Wednesday" class="font-medium text-gray-700">Wednesday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="Thursday" name="days[4]" type="checkbox" value="THU" <?php  if($rid!='') if (in_array('THU', $arr_serviceDays)) echo "checked" ; ?> class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="Thursday" class="font-medium text-gray-700">Thursday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="Friday" name="days[5]" type="checkbox" value="FRI" <?php  if($rid!='') if (in_array('FRI', $arr_serviceDays)) echo "checked"; ?> class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="Friday" class="font-medium text-gray-700">Friday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="Saturday" name="days[6]" type="checkbox" value="SAT" <?php  if($rid!='') if (in_array('SAT', $arr_serviceDays)) echo "checked"; ?> class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="Saturday" class="font-medium text-gray-700">Saturday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="space-y-6 divide-y divide-gray-200  sm:space-y-5 sm:pt-10">
      <div class="space-y-6 divide-y divide-gray-200 sm:space-y-5">

      </div>
    </div>
    </div>

    <div class="pt-5">
      <div class="flex justify-center">
        <button type="reset" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
        <button type="submit" name="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
      </div>
    </div>
  </form>
</body>

</html>