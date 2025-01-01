<x-userLayout>
    <div class="container mx-auto p-10 max-w-7xl">
        <h1 class="text-4xl font-bold text-blue-800 mb-8 text-center">Quiz Analytics</h1>

        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Questions</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correct Answers</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score (%)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($analytics as $analytic)
                    <tr class="border-b">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $analytic->category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $analytic->total_questions }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $analytic->correct_answers }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $analytic->score }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $analytic->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-userLayout>
