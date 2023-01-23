<html>

<head>
    <title>Trains Form</title>

    <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
</head>

<body class="ml-24 bg-slate-200">

    <?php
    include 'db.php';
    include 'operations.php';
    $dbObj = new dbOperation();
    //$routeList = $dbObj->getTable('train_routes',false,false,false,false);
    $sourceList = $dbObj->getTable('train_routes', false, false, 'source', 'source,source_code');
    $sourceList = array_map("unserialize", array_unique(array_map("serialize", $sourceList)));
    $destinationList = $dbObj->getTable('train_routes', false, false, 'destination', 'destination,destination_code');
    $destinationList = array_map("unserialize", array_unique(array_map("serialize", $destinationList)));
    $trainNames = $dbObj->getTable('train_info', false, false, false, 'id,train_name');
    foreach ($trainNames as $key => $value) {
        $trainNames[$value['id']] = $value['train_name'];
    }
    $trainNo = $dbObj->getTable('train_info', false, false, false, 'id,train_no');
    foreach ($trainNo as $key => $value) {
        $trainNo[$value['id']] = $value['train_no'];
    }
    $trainType = $dbObj->getTable('train_info', false, false, false, 'id,train_type');
    foreach ($trainType as $key => $value) {
        $trainType[$value['id']] = $value['train_type'];
    }
    ?>

    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">

        <div class="space-y-6 pt-8 sm:space-y-5 sm:pt-10">
            <div>
                <h3 class="text-3xl font-bold text-amber-900 leading-6 mb-7">Train booking form</h3>
            </div>

            <form action="booking_form.php" method="POST" class="space-y-8 divide-y divide-gray-200">
                <div class="space-y-6 sm:space-y-5">

                    <div class="flex flex-row w-full space-x-4">
                        <div class="sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5 w-1/4">
                            <label for="source" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 ">Source</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <select id="source" name="source" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
                                    <?php foreach ($sourceList as $key => $sl) { ?>
                                        <option value="<?php echo $sl['source_code'] ?>"><?php echo $sl['source'] ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>

                        <div class="sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5 w-1/4">
                            <label for="source" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Destination</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <select id="destination" name="destination" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">

                                    <?php foreach ($destinationList as $key => $dl) { ?>
                                        <option value="<?php echo $dl['destination_code'] ?>"><?php echo $dl['destination'] ?></option>

                                    <?php  } ?>
                                </select>
                            </div>
                        </div>
                        <div class="sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5 w-1/4">
                            <label for="date" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Date</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <input type="date" name="date" min="<?php  ?>" id="date" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm mr-96">
                            </div>
                        </div>

                        <div class="sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5 w-1/4">
                            <div class="flex justify-center pt-10">
                                <input type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" value="Search">
                            </div>
                        </div>
                    </div>


                </div>
        </div>

        <div class="space-y-6 divide-y divide-gray-200  sm:space-y-5 sm:pt-10">
        </div>
    </div>
    </div>
    </form>

    <?php
    if ($_POST) {
        $source = $_POST['source'];
        $destination = $_POST['destination'];
        $date = $_POST['date'];
        $firstDate = date('d-F', strtotime($date . ' +1 day'));
        $secondDate = date('d-F', strtotime($firstDate . ' +1 day'));
        $thirdDate = date('d-F', strtotime($secondDate . ' +1 day'));
        //   exit;

        $day = strtoupper(date('D', strtotime($date)));
        $sql = " SELECT * FROM train_routes WHERE source_code='$source' AND destination_code='$destination' AND FIND_IN_SET('$day',service_days) > 0";
        // echo $sql;
        $res = mysqli_query($conn, $sql);
        $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
        // print_r($data);
        // exit;
        // echo $data['source_code'];

    ?>

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Train Details</h1>
                    <p class="mt-2 text-sm font-semibold text-gray-700">A list of all the trains in the specified source , destination and day.</p>
                    <p class="mt-2 text-l font-bold text-green-800"><?php echo "Date of journey: " . date('d-F-Y', strtotime($date)) . " , " . date('l', strtotime($day)) ?></p>
                </div>

                <div class="flex flex-row">
                    <div>
                        <form action="booking_form.php" method="POST">
                            <input type="hidden" name="source" value="<?php echo $source ?>">
                            <input type="hidden" name="destination" value="<?php echo $destination ?>">
                            <input type="hidden" name="date" value="<?php echo $firstDate ?>">
                            <input type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" value=<?php echo $firstDate ?>>
                        </form>
                    </div>

                    <div>
                        <form action="booking_form.php" method="POST">
                            <input type="hidden" name="source" value="<?php echo $source ?>">
                            <input type="hidden" name="destination" value="<?php echo $destination ?>">
                            <input type="hidden" name="date" value="<?php echo $secondDate ?>">
                            <input type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" value=<?php echo $secondDate ?>>
                        </form>
                    </div>
                    <div>
                        <form action="booking_form.php" method="POST">
                            <input type="hidden" name="source" value="<?php echo $source ?>">
                            <input type="hidden" name="destination" value="<?php echo $destination ?>">
                            <input type="hidden" name="date" value="<?php echo $thirdDate ?>">
                            <input type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" value=<?php echo $thirdDate ?>>
                        </form>
                    </div>
                </div>

            </div>
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Train Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Source</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Departure Time</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Destination</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Arrival Time</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Available Seats</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Book</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <?php
                                    foreach ($data as $key => $value) 
                                    {
                                         $trainId=$value['train_id'];
                                         $arrResults=$dbObj->getTable('booking_details',array('route_id','booking_date'),array($value['id'],"'$date'"),false);
                                         $bookedSeats= sizeof($arrResults);
                                         $totalSeats=$dbObj->getRow('train_info',array('id'),array($trainId),'total_seat')['total_seat'];
                                        //  echo $bookedSeats;
                                        //  echo $totalSeats;
                                         ?>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img class="h-10 w-10 rounded-full" src="images/train<?php echo $key?>.jpg" alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="font-medium text-gray-900"><?php echo ucfirst($trainNames[$value['train_id']]); ?></div>
                                                        <div class="text-gray-500"><?php echo "Train No: " . $trainNo[$value['train_id']]; ?></div>
                                                        <div class="text-gray-500"><?php if ($trainType[$value['train_id']] == 0) echo "Passenger";
                                                                                    else echo "Express"; ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div class="text-gray-900"><?php echo ucfirst($value['source']); ?></div>
                                                <!-- <div class="text-gray-500">Optimization</div> -->
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <span class="inline-flex rounded-full bg-green-100 px-2 text-l font-semibold leading-5 text-green-800"><?php echo date("g:i A", strtotime($value['departure_time'])) ?></span>

                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div class="text-gray-900"><?php echo ucfirst($value['destination']); ?></div>
                                            </td>

                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <span class="inline-flex rounded-full bg-green-100 px-2 text-l font-semibold leading-5 text-green-800"><?php echo date("g:i A", strtotime($value['arrival_time'])) ?></span>

                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div class="text-gray-900"><?php echo ($totalSeats - $bookedSeats)?></div>
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Book<span class="sr-only">, Lindsay Walton</span></a>
                                            </td>
                                        </tr>
                                    <?php  }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


</body>

</html>