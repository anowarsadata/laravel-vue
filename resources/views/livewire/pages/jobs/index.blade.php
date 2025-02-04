<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center py-8">
            <h1 class="text-2xl font-bold">Jobs</h1>
        </div>
        <div class="w-full">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">Title</th>
                                <th class="px-4 py-3">Description</th>
                                <th class="px-4 py-3">Company Logo</th>
                                <th class="px-4 py-3">Company Name</th>
                                <th class="px-4 py-3">Experience</th>
                                <th class="px-4 py-3">Salary</th>
                                <th class="px-4 py-3">Location</th>
                                <th class="px-4 py-3">Skills</th>
                                <th class="px-4 py-3">Extra Info</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-semibold text-gray-900 dark:text-white">{{ $job->title }}</td>
                                    <td class="px-4 py-3">{{ Str::words($job->description, 7) }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @if ($job->company_logo)
                                            <img src="{{ asset('storage/'.$job->company_logo) }}" class="h-12 w-auto mx-auto" alt="{{ $job->company_name }}">
                                        @else
                                            <span class="text-gray-500">No Logo</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $job->company_name }}</td>  
                                    <td class="px-4 py-3">{{ $job->experience }}</td>
                                    <td class="px-4 py-3">{{ $job->salary }}</td>
                                    <td class="px-4 py-3">{{ $job->location }}</td>
                                    
                                    <td class="px-4 py-3">
                                        <div class="flex items-center flex-wrap gap-2">
                                            @foreach ($job->skills as $skill)
                                                <span class="inline-block bg-gray-200 rounded-full px-2 py-0.5 text-xs font-medium text-gray-700">
                                                    {{ $skill->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach (explode(',', $job->extra_info) as $extra)
                                                <span class="bg-amber-100 rounded-full px-2 py-0.5 text-xs font-medium text-amber-800">{{ trim($extra) }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button wire:click="deleteJob({{ $job->id }})" class="text-sm px-3 py-1.5 rounded hover:bg-red-100 transition-colors text-red-500">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(session()->has('successMessage'))
                        <div class="bg-green-100 text-green-700 px-4 py-2 mt-4 rounded">
                            {{ session('successMessage') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
