<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" th:if="${#authorization.expression('hasRole(''ROLE_MANAGER'') or hasRole(''ROLE_EMPLOYEE'')')}">
                <li class="user-pro">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <img src="{{asset('/images/pp.png')}}" class="img-circle">
                        <span class="hide-menu">Admin</span>
                    </a>
                </li>
                <li class="nav-small-cap">--- Dashboard</li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)">
                        <i class="fas fa-cogs"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                    <ul class="collapse">
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ url('/configurations/expense-threshold/edit') }}">Edit expense threshold</a></li>
                        <li><a href="{{ url('/budgets') }}">All budgets</a></li>
                        <li><a href="{{ url('/expenses/tickets') }}">Tickets expenses</a></li>
                        <li><a href="{{ url('/expenses/leads') }}">Leads expenses</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
