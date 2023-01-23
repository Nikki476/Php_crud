<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ROUTE_LIST</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
</head>

<body>

  <?php
    $showAlert = false;
    if (isset($_GET['insert']) && $_GET['insert'] == 'success') {
      $showAlert = true;
      $alertMsg = 'Route details are inserted successfully';
      $bgColor = 'bg-green-50';
      $textColor = 'text-green-800';
      $alertIcon = '<svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
  </svg>';
    }
    if (isset($_GET['update']) && $_GET['update'] == 'success') {
      $showAlert = true;
      $alertMsg = 'The route details have been updated successfully';
      $bgColor = 'bg-green-50';
      $textColor = 'text-green-800';
      $alertIcon = '<svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
  </svg>';
    }
    if (isset($_GET['delete']) && $_GET['delete'] == 'success') {
      $showAlert = true;
      $alertMsg = 'The route details have been deleted successfully';
      $bgColor = 'bg-red-50';
      $textColor = 'text-red-800';
      $alertIcon = '<svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
  </svg>';
    }
    if ($showAlert == true) {
    ?> <div class="rounded-md <?php echo $bgColor; ?> p-4">
    <div class="flex">
      <div class="flex-shrink-0">
        <!-- Heroicon name: mini/check-circle -->
        <?php echo $alertIcon; ?>
      </div>
      <div class="ml-3">
        <h3 class="text-sm font-medium <?php echo $textColor; ?>"><?php echo $alertMsg; ?></h3>
        <!-- <div class="mt-2 text-sm text-green-700">
              <p>Train details are inserted successfully</p>
            </div> -->
        <div class="mt-4">
          <div class="-mx-2 -my-1.5 flex">
            <!-- <button type="button" class="rounded-md bg-green-50 px-2 py-1.5 text-sm font-medium text-green-800 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">View status</button> -->
            <!-- <button type="button" class="ml-3 rounded-md bg-green-50 px-2 py-1.5 text-sm font-medium text-green-800 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">Dismiss</button> -->
          </div>
        </div>
      </div>
    </div>
    </div>
  <?php
    }
  ?>

  <div class="px-4 sm:px-6 lg:px-8 pt-10">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Train Route Details</h1>
        <p class="mt-2 text-sm text-gray-700">A list of all the trains including their routes, departure time , arrival time and number of days available is listed here.</p>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <!-- <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add</button> -->
        <a href="route.php" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add</a>
      </div>
    </div>
    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">

            <?php
            include 'operations.php';
            $dbObj = new dbOperation();
            $trainList = $dbObj->getTable('train_routes', false, false, false);
            $trainInfo = $dbObj->getTable('train_info', false, false, false);
            foreach ($trainInfo as $key => $value) {
              $trainNames[$value['id']] = $value['train_name'];
            }
            //print_r($trainNames);

            if (isset($_GET['id'])) {
              $delid = $_GET['id'];
              $dbObj = new dbOperation();
              $res = $dbObj->delete('train_routes', 'id', $delid);

              if ($res) { ?>
                <script>
                  location.href = "route_list.php?delete=success"
                </script>
            <?php }
            }

            ?>
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Sl.No:</th>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Train Name</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Source</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Destination</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Departure Time</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Arrival Time</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Available Days</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <?php
                $i = 1;
                foreach ($trainList as $key => $value) {
                ?>
                  <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"><?php echo $i++; ?></td>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"><?php echo $trainNames[$value['train_id']] ?></td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $value['source'] ?></td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $value['destination'] ?></td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $value['departure_time'] ?></td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $value['arrival_time'] ?></td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $value['service_days'] ?></td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                      <a href="route.php?id=<?php echo $value['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
                    </td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                      <a href="route_list.php?id=<?php echo $value['id'] ?>" class="text-red-600 hover:text-red-900">Delete<span class="sr-only">, Lindsay Walton</span></a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>