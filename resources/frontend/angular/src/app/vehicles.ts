export interface Vehicle {
  id: number;
  company_id: number;
  name: string;
}

export const vehicles = [
  {
    id: 1,
    company_id: 1,
    name: 'Falcon Heavy'
  },
  {
    id: 2,
    company_id: 1,
    name: 'Falcon 9'
  },
  {
    id: 3,
    company_id: 2,
    name: 'New Shepard'
  },
  {
    id: 4,
    company_id: 3,
    name: 'Soyuz'
  },
  {
    id: 5,
    company_id: 4,
    name: 'Hyperbola-2'
  }
]
