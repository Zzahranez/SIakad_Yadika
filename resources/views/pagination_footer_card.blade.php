 <!-- Card Footer -->
 <div class="card-footer bg-white p-3 d-flex justify-content-between align-items-center">
     <span>
         Menampilkan <strong>{{ $collection->firstItem() }}</strong> sampai <strong>{{ $collection->lastItem() }}</strong> dari total
        <strong>{{ $collection->total() }}</strong>  
     </span>
     <nav aria-label="Navigasi halaman">
         <ul class="pagination pagination-sm mb-0">
             <!-- Previous Page -->
             <li class="page-item  {{ $collection->onFirstPage() ? 'disabled' : '' }}">
                 <a class="page-link hover-smooth" href="{{ $collection->previousPageUrl() ?? '#' }}" aria-label="Sebelumnya">
                     <i class="fas fa-chevron-left"></i>
                 </a>
             </li>

             <!-- First Page -->
             @if ($collection->lastPage() > 1)
                 <li class="page-item {{ $collection->currentPage() == 1 ? 'active' : '' }}">
                     <a class="page-link hover-smooth" href="{{ $collection->url(1) }}">1</a>
                 </li>
             @endif

             <!-- Ellipsis if needed -->
             @if ($collection->currentPage() > 3)
                 <li class="page-item disabled">
                     <span class="page-link">...</span>
                 </li>
             @endif

             <!-- Pages around current page -->
             @php
                 $start = max(2, $collection->currentPage() - 2);
                 $end = min($collection->lastPage() - 1, $collection->currentPage() + 2);
             @endphp
             @for ($i = $start; $i <= $end; $i++)
                 <li class="page-item {{ $collection->currentPage() == $i ? 'active' : '' }}">
                     <a class="page-link hover-smooth" href="{{ $collection->url($i) }}">{{ $i }}</a>
                 </li>
             @endfor

             <!-- Ellipsis if needed -->
             @if ($collection->currentPage() < $collection->lastPage() - 2)
                 <li class="page-item disabled">
                     <span class="page-link">...</span>
                 </li>
             @endif

             <!-- Last Page -->
             @if ($collection->lastPage() > 1)
                 <li class="page-item {{ $collection->currentPage() == $collection->lastPage() ? 'active' : '' }}">
                     <a class="page-link hover-smooth"
                         href="{{ $collection->url($collection->lastPage()) }}">{{ $collection->lastPage() }}</a>
                 </li>
             @endif

             <!-- Next Page -->
             <li class="page-item {{ !$collection->hasMorePages() ? 'disabled' : '' }}">
                 <a class="page-link hover-smooth" href="{{ $collection->nextPageUrl() ?? '#' }}" aria-label="Berikutnya">
                     <i class="fas fa-chevron-right"></i>
                 </a>
             </li>
         </ul>
     </nav>
 </div>
 <!-- End Footer-->
