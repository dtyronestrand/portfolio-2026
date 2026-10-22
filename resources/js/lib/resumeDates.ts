const monthYear = new Intl.DateTimeFormat('en-US', {
    month: 'short',
    year: 'numeric',
    timeZone: 'UTC',
});

/**
 * Formats a `Y-m-d` date as "Mar 2020". Parsed as UTC so the month never
 * slips backwards in time zones west of Greenwich.
 */
export function formatMonthYear(date: string | null, fallback = 'Present') {
    if (!date) {
        return fallback;
    }

    const [year, month] = date.split('-').map(Number);

    return monthYear.format(new Date(Date.UTC(year, (month || 1) - 1, 1)));
}

export function formatYear(date: string) {
    return date.slice(0, 4);
}
