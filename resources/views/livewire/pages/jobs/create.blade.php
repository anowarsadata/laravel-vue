<div class="container mx-auto py-4">
    <div class="flex justify-between items-center py-8">
        <h1 class="text-2xl font-bold">Jobs</h1>
    </div>
    
    <div class="w-full">
        <!-- Job Creation Form -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold mb-4 text-gray-900">Create New Job Posting</h2>

            @if ($successMessage)
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ $successMessage }}
                </div>
            @endif

            <form wire:submit.prevent="saveJobPost">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Job Details -->
                    <div class="md:col-span-2 bg-gray-100 p-6 rounded-md shadow-md border-t border-gray-300">
                        <h3 class="text-md font-semibold mb-2">Job Details</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700">Title</label>
                                <input type="text" wire:model="title" placeholder="Enter job title, e.g., Software Engineer" class="w-full p-2 border rounded-md">
                                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700">Description</label>
                                <textarea wire:model="description" placeholder="Provide a brief job description..." class="w-full p-2 border rounded-md"></textarea>
                                @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Experience</label>
                                    <input type="text" wire:model="experience" placeholder="e.g., 1-3 years" class="w-full p-2 border rounded-md">
                                    @error('experience') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700">Salary</label>
                                    <input type="text" wire:model="salary" placeholder="e.g., 3-5 LPA" class="w-full p-2 border rounded-md">
                                    @error('salary') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Location</label>
                                    <input type="text" wire:model="location" placeholder="e.g., Remote / New York" class="w-full p-2 border rounded-md">
                                    @error('location') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700">Extra Info</label>
                                    <input type="text" wire:model="extra_info" placeholder="e.g., Full-Time, Urgent, Part-Time" class="w-full p-2 border rounded-md">
                                    <p class="text-sm text-gray-500">Use comma-separated values.</p>
                                    @error('extra') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Company & Skills -->
                    <div class="bg-gray-100 p-6 rounded-md shadow-md border-t border-gray-300">
                        <h3 class="text-md font-semibold mb-2">Company Details</h3>
                        <div>
                            <label class="block text-gray-700">Company Name</label>
                            <input type="text" wire:model="company_name" placeholder="Enter company name, e.g., TechCorp" class="w-full p-2 border rounded-md">
                            @error('company_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Company Logo</label>
                            <input type="file" wire:model="company_logo" class="w-full p-2 border rounded-md">
                            @error('company_logo') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            
                            @if ($company_logo)
                                <img src="{{ $company_logo->temporaryUrl() }}" class="w-24 h-24 object-cover mt-2">
                            @endif
                        </div>

                        <!-- Skills -->
                        <h3 class="text-md font-semibold mb-2">Skills</h3>
                        <div>
                            <label class="block text-gray-700">Select Skills</label>
                            <select wire:model="selectedSkills" multiple class="w-full p-2 border rounded-md">
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-500">Hold Ctrl (Windows) or Cmd (Mac) to select multiple skills.</p>
                            @error('selectedSkills') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
