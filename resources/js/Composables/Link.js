export function useLink(id) {
    const sideNavLinks = [
        {label: 'Dashboard', icon: 'home', route: 'dashboard', base_route: 'dashboard'},
        { label: 'Apointment', icon: 'hotel', route: 'apointment.index', base_route: 'apointment.*',  access: 'Admin' },
        // { label: 'Note Log', icon: 'paper-plane', route: 'notes.index', base_route: 'notes.*' ,access: 'Hotel Admin'},
        // { label: "VIP's", icon: 'star', route: 'vip.index', base_route: 'vip.*' ,access: 'Hotel Admin'},
        // { label: 'Guests', icon: 'user-vneck-hair', route: 'guest.index', base_route: 'guest.*', access: 'Hotel Admin' },
        // { label: 'Celebrations', icon: 'balloons', route: 'celebration.index', base_route: 'celebration.*', access: 'Hotel Admin' }, //new
        // { label: 'Hurdles', icon: 'plus', route: 'hurdles.index', base_route: 'hurdles.*',access: 'Hotel Admin' },
        // { label: 'Allergies', icon: 'person-dots-from-line', route: 'allergy.index', base_route: 'allergy.*' ,access: 'Hotel Admin' },
        // { label: 'My Team', icon: 'people-group', route: 'team.index', base_route: 'team.*', access: 'Hotel Admin' },
        // { label: 'Guest Surveys', icon: 'square-poll-horizontal', route: 'guest-survey.index', base_route: 'guest-survey.*', access: 'Hotel Admin' }, //new
        // { label: 'Reservations', icon: 'presentation-screen', route: 'reservations.index', base_route: 'reservations.*', access: 'Hotel Admin' },
        // { label: 'Reports', icon: 'scroll', route: 'report.index', base_route: 'report.*' }, //new
        // { label: 'Profile', icon: 'id-badge', route: 'profile.account', base_route: 'profile.*' },
    ];
    return {
        sideNavLinks
    }
}
