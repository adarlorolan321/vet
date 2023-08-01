export function useLink(id) {
    const sideNavLinks = [
        {label: 'Dashboard', icon: 'home', route: 'dashboard', base_route: 'dashboard'},
        { label: 'Calendar', icon: 'hotel', route: 'apointment.index', base_route: 'apointment.*',  access: 'Admin' },
        { label: 'Unavailable Dates', icon: 'paper-plane', route: 'unavailable-dates.index', base_route: 'unavailable-dates.*' ,access: 'Admin'},
        { label: "Dental Services", icon: 'star', route: 'dental-services.index', base_route: 'dental-services.*' ,access: 'Admin'},
       
    ];
    return {
        sideNavLinks
    }
}
