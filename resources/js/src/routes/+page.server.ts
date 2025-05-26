import {redirect, type RequestEvent} from "@sveltejs/kit";

export const load = ({cookies}: RequestEvent) => {
    // Temporarily disabled authentication
    // const user = cookies.get('reback_user')
    // if (user) {
    //     throw redirect(302, '/dashboards/analytics');
    // }
    // throw redirect(302, '/auth/sign-in');

    // Allow direct access without authentication
    return {};
};
