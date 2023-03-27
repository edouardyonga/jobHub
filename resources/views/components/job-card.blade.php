@props(['job'])

<x-card>
  <div class="flex text-black">
    <img class="hidden w-48 mr-6 md:block" src="{{$job->logo ? asset('storage/'.$job->logo) : asset('https://www.shoshinsha-design.com/wp-content/uploads/2020/05/noimage_%E3%83%92%E3%82%9A%E3%82%AF%E3%83%88-580x440.png')}}" alt="logo" />
    <div>
      <h3 class="text-2xl">
        <a href="/jobs/{{$job->id}}">{{$job->title}}</a>
      </h3>
      <div class="text-xl font-bold mb-4">{{$job->company}}</div>
      <x-job-tags :tagsCsv="$job->tags" />
      <div class="text-lg mt-4">
        <i class="fa-solid fa-location-dot"></i> {{$job->location}}
      </div>
    </div>
  </div>
</x-card>
