<h3>Rate this recipe!</h3>
<br/>
<ul class="grid grid-flow-col">
  <li class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" onclick="submitRatingForm(1)">
    1
  </li>
  <li class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" onclick="submitRatingForm(2)">
    2
  </li>
  <li class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" onclick="submitRatingForm(3)">
    3
  </li>
  <li class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" onclick="submitRatingForm(4)">
    4
  </li>
  <li class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" onclick="submitRatingForm(5)">
    5
  </li>
</ul>

<form id="rating-form" class="hidden" method="POST" action="/rating">
  <input type="hidden" name="id" value="<?= $recipe['recipe_id'] ?>">
  <input type="hidden" name="rating_value" id="rating-value">
</form>