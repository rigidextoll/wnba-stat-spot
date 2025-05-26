import {error} from '@sveltejs/kit';

export function load({params}) {
    if (params.id) {
        return {
            id: params.id
        };
    }

    error(404, 'Not found');
}