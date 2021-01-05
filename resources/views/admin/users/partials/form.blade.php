@csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" placeholder="Enter Name" 
                                value="{{ old('name') }} @isset($user) {{ $user->name }} @endisset">
                        @error('name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" placeholder="Enter Email" 
                            value="{{ old('email') }} @isset($user) {{ $user->email }} @endisset">
                        @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror    
                    </div>
                    @isset($create)
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    @endisset
                    <div class="mb-3">
                        @foreach($roles as $role)
                            <!-- <div class="form-check">
                                <input class="form-check-input" name="roles[]"
                                        type="checkbox" value="{{ $role->id }}" id="{{ $role->name }}"
                                        @isset($user) 
                                        @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked 
                                        @endif 
                                        @endisset>
                                <label class="form-check-label" for="{{$role->name}}">
                                    {{ $role->name }}
                                </label>
                            </div> -->

                            <div class="form-check @error('role') is-invalid @enderror">
                                <input class="form-check-input @error('role') is-invalid @enderror" type="radio" 
                                        name="role" id="{{$role->name}}" value="{{ $role->id }}"
                                        
                                        @isset($user) 
                                        @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked 
                                        @endif 
                                        @endisset
                                        
                                >
                                
                                <label class="form-check-label" for="{{$role->name}}">
                                    {{ $role->name }}
                                </label>
                                </div>

                        @endforeach

                        @error('role')
                            <span class="invalid-feedback" role="alert">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>