export default [
  {
    name: 'NAVIGATION'
  },
  {
    name: 'Home',
    link: '/',
    icon: 'fa-home'
  },
  {
    name: 'News',
    link: '/news',
    icon: 'fa-newspaper-o',
    child: [
      {
        name: 'Add a news',
        link: '/news/add',
        icon: 'fa-plus-circle',
        require: 'administrator'
      }
    ]
  },
  {
    name: 'Photos',
    link: '/photos',
    icon: 'fa-photo',
    child: [
      {
        name: 'Add a photo',
        link: '/photo/add',
        icon: 'fa-plus-circle',
        require: 'authenticated'
      }
    ]
  },
  {
    name: 'DATABASE'
  },
  {
    name: 'Search',
    link: '/search',
    icon: 'fa-search'
  },
  {
    name: 'Boxes',
    link: '/boxes',
    icon: 'icon-icon_nendo_boxes',
    child: [
      {
        name: 'Add a box',
        link: '/box/add',
        icon: 'fa-plus-circle',
        require: 'editor'
      }
    ]
  },
  {
    name: 'Nendoroids',
    link: '/nendoroids',
    icon: 'icon-icon_nendo_nendo'
  },
  {
    name: 'Faces',
    link: '/faces',
    icon: 'icon-icon_nendo_face'
  },
  {
    name: 'Hairs',
    link: '/hairs',
    icon: 'icon-icon_nendo_hair'
  },
  {
    name: 'Hands',
    link: '/hands',
    icon: 'icon-icon_nendo_hand'
  },
  {
    name: 'Bodyparts',
    link: '/bodyparts',
    icon: 'icon-icon_nendo_body'
  },
  {
    name: 'Accessories',
    link: '/accessories',
    icon: 'icon-icon_nendo_accessories'
  },
  {
    name: 'OTHERS'
  },
  {
    name: 'About',
    link: '/about',
    icon: 'fa-info-circle'
  }
]
