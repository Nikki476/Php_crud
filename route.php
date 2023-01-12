<html>

<head>
  <title>ROUTE</title>
  <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
</head>

<body class="ml-24 bg-slate-200">
  <?php
  include 'operations.php';
  $obj = new dbOperation();

  ?>

  <form class="space-y-8 divide-y divide-gray-200">
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">

      <div class="space-y-6 pt-8 sm:space-y-5 sm:pt-10">
        <div>
          <h3 class="text-3xl font-bold text-amber-900 leading-6 mb-7">Route</h3>
          <!-- <p class="mt-1 max-w-2xl text-sm text-gray-500">Use a permanent address where you can receive mail.</p> -->
        </div>
        <div class="space-y-6 sm:space-y-5">
          <div class="flex flex-row">
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
              <label for="source" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Source</label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                <input type="text" name="source" id="source" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
              </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5 px-32">
              <label for="source_code" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 pr-6">Source Code</label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                <input type="text" name="source_code" id="source_code" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
              </div>
            </div>
          </div>
          <div class="flex flex-row">
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
              <label for="dest" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Destination</label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                <input type="text" name="dest" id="dest" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
              </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5 px-32">
              <label for="dest_code" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Destination Code</label>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                <input type="text" name="dest_code" id="dest_code" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
              </div>
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="train_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Train Name</label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <select id="train_name" name="train_name" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>
            </div>
          </div>

          <div role="group" aria-labelledby="label-email">
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
              <div>
                <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700" id="label-email">Days</div>
              </div>
              <div class="mt-4 sm:col-span-2 sm:mt-0">
                <div class="max-w-lg space-y-4">
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="comments" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="comments" class="font-medium text-gray-700">Sunday</label>
                      <!-- <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="candidates" name="candidates" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="candidates" class="font-medium text-gray-700">Monday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate applies for a job.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="offers" class="font-medium text-gray-700">Tuesday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="offers" class="font-medium text-gray-700">Wednesday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="offers" class="font-medium text-gray-700">Thursday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="offers" class="font-medium text-gray-700">Friday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p> -->
                    </div>
                  </div>
                  <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                      <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="offers" class="font-medium text-gray-700">Saturday</label>
                      <!-- <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p> -->
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="last-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Departure Time</label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <input type="time" name="last-name" id="last-name" autocomplete="family-name" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="last-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Arrival Time</label>
            <div class="mt-1 sm:col-span-2 sm:mt-0">
              <input type="time" name="last-name" id="last-name" autocomplete="family-name" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- </div>
                </div>
              </div>
            </div>
          </div> -->

    <div class="space-y-6 divide-y divide-gray-200  sm:space-y-5 sm:pt-10">
      <!-- <div>
              <h3 class="text-lg font-medium leading-6 text-gray-900">Notifications</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">We'll always let you know about important changes, but you pick what else you want to hear about.</p>
            </div> -->
      <div class="space-y-6 divide-y divide-gray-200 sm:space-y-5">

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