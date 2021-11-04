import { usePage } from '@inertiajs/inertia-react';

export default function () {
  const { auth } = usePage().props;
  return auth.user || null;
}
