<div>
  <div class="md:flex md:items-center md:justify-between">
    <div class="min-w-0 flex-1">
      <h2 class="text-2xl font-bold leading-7 text-gray-600 sm:truncate uppercase sm:tracking-tight">EXPENSES
      </h2>
    </div>
    <div class="mt-4 flex md:mt-0 md:ml-4">
      <a href="{{ route('back-office.manage-category') }}"
        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">MANAGE
        CATEGORY</a>
      <a href="{{ route('back-office.add-expenses') }}"
        class="ml-3 inline-flex items-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">ADD
        NEW</a>
    </div>
  </div>
  <div class="px-4 sm:px-6 lg:px-8">

    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden md:rounded-lg">
            <table class="min-w-full">
              <thead class="bg-white border-t">
                <tr>
                  <th scope="col"
                    class="py-3.5 w-32 pl-4 pr-3 text-left text-sm font-semibold uppercase text-gray-900 sm:pl-6">

                  </th>
                  <th scope="col"
                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold uppercase text-gray-900 sm:pl-6">
                    Expense Name
                  </th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold uppercase text-gray-900">
                    Description</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold uppercase text-gray-900">Amount
                  </th>

                </tr>
              </thead>
              <tbody class="bg-white">
                @forelse ($expenseCategories as $category)
                  <tr class="border-t border-gray-200">
                    <th colspan="5" scope="colgroup"
                      class="bg-gray-100 px-4 py-2 text-left text-sm font-semibold  text-gray-900 sm:px-6">
                      <div class="flex space-x-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-green-600"
                          width="24" height="24">
                          <path fill="none" d="M0 0h24v24H0z" />
                          <path
                            d="M20.083 10.5l1.202.721a.5.5 0 0 1 0 .858L12 17.65l-9.285-5.571a.5.5 0 0 1 0-.858l1.202-.721L12 15.35l8.083-4.85zm0 4.7l1.202.721a.5.5 0 0 1 0 .858l-8.77 5.262a1 1 0 0 1-1.03 0l-8.77-5.262a.5.5 0 0 1 0-.858l1.202-.721L12 20.05l8.083-4.85zM12.514 1.309l8.771 5.262a.5.5 0 0 1 0 .858L12 13 2.715 7.429a.5.5 0 0 1 0-.858l8.77-5.262a1 1 0 0 1 1.03 0z" />
                        </svg>
                        <span class="uppercase text-green-600">{{ $category->name }}</span>
                      </div>
                    </th>
                  </tr>

                  @forelse ($category->expenses as $item)
                    <tr class="border-t border-gray-300">
                      <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                      </td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $item->name }}</td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $item->description }}</td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        &#8369;{{ number_format($item->amount, 2) }}
                      </td>


                    </tr>
                  @empty
                    <td colspan="4" class="py-2 text-center">
                      <span class="text-center text-sm text-gray-500">No data available.</span>
                    </td>
                  @endforelse
                @empty
                @endforelse



                <!-- More people... -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
