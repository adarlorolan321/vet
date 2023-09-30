export function useLink(id) {
    const sideNavLinks = [
        {label: 'Dashboard', icon: 'home', route: 'dashboard', base_route: 'dashboard'},
        {label: 'Pet Owner', icon: 'home',  route: 'patients.index', base_route: 'patients.*',  access: 'Admin'},
        { label: 'Appointment', icon: 'hotel', route: 'apointment.index', base_route: 'apointment.*',  access: 'Admin' },
        // { label: 'Unavailable Dates', icon: 'paper-plane', route: 'unavailable-dates.index', base_route: 'unavailable-dates.*' ,access: 'Admin'},
        // { label: 'Payments', icon: 'paper-plane', route: 'payments.index', base_route: 'payments.*' ,access: 'Admin'},
        { label: "Vet Service", icon: 'star', route: 'vet-services.index', base_route: 'vet-services.*' ,access: 'Admin'},
        { label: 'Pet History', icon: 'paper-plane', route: 'user-history.index', base_route: 'user-history.*' ,access: 'Admin'},
       
    ];
    return {
        sideNavLinks
    }
}
