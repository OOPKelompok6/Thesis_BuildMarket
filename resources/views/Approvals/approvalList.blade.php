<x-layout>
    <div class="d-flex flex-column w-100 min-vh-100 align-items-center">
        <div class="d-flex w-50 flex-column bg-light mx-auto my-auto rounded-5">
            <div style="height: 3.5rem" class="bg-dark p-0 m-0 w-100 rounded-top-5"></div>

            @if (count($approvals) == 0)
                <p class="fs-3 text-dark mx-auto my-5">Empty Approval List</p>
            @else
                <div class="text-dark w-75 me-auto my-4 ms-4 fs-3 fw-bold">Approval List</div>
                <div class="d-flex flex-row mx-auto mb-4">
                    <table class="table table-striped table-borderless">

                        <thead>
                            <tr>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">User ID</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Date</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Nomor NPWP</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Approval Files</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Actions</span></div></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($approvals as $approval)
                            <tr>
                                <td>{{ $approval->user_id }}</td>
                                <td>{{ (new DateTime($approval->created_Date))->format('Y-m-d') }}</td>
                                <td>{{ $approval->npwp_number }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a class="my-auto mx-auto" href="{{ $approval->blob_link }}">
                                            <i class="bi bi-file-arrow-down"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row gap-3">
                                        <button form="delete-form-{{ $approval->id }}" class="btn-sm text-light bg-danger rounded-3 my-0 py-0">Reject</button>
                                        <button form="approve-form-{{ $approval->id }}" class="btn-sm text-light bg-primary rounded-3">Approve</button>
                                    </div>
                                </td>

                                <form id="delete-form-{{ $approval->id }}" class="hidden" method="POST" action="/approvalList/{{ $approval->id }}">
                                        @csrf
                                        @method('DELETE')
                                </form>
                                <form id="approve-form-{{ $approval->id }}" class="hidden" method="POST" action="/approvalList/{{ $approval->id }}">
                                    @csrf
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex ms-auto me-5 gap-2">
                    {{ $approvals->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>