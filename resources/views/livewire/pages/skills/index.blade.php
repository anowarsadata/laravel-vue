<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Skills Management</h1>
        </div>

        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Skills Table -->
            <div class="bg-white shadow-md rounded-lg w-full md:w-2/3 p-4">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-100 text-gray-600">
                            <th class="py-3 px-4 uppercase text-sm">Name</th>
                            <th class="py-3 px-4 text-right uppercase text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $skill->name }}</td>
                                <td class="py-3 px-4 text-right">
                                    <button wire:click="edit({{ $skill->id }})" class="text-blue-500 hover:underline mr-4">Edit</button>
                                    <button wire:click="delete({{ $skill->id }})" class="text-red-500 hover:underline">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Add/Edit Skill Form -->
            <div class="bg-white shadow-md rounded-lg p-6 w-full md:w-1/3">
                <h2 class="text-lg font-semibold mb-4">{{ $skillId ? 'Edit' : 'Add' }} Skill</h2>
                
                <form wire:submit.prevent="{{ $skillId ? 'update' : 'store' }}">
                    <div class="mb-4">
                        <label class="block text-gray-600 font-medium">Name</label>
                        <input type="text" wire:model="name" placeholder="Skill name" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        {{ $skillId ? 'Update' : 'Save' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
