const ctx = document.getElementById('followChart');

    followings = parseInt("<?php count($_SESSION['userFollowings']); ?>");
    followers = 0;

    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: ['Followers', 'Followings'],
        datasets: [{
            label: 'Nombres actuels de followers et de following',
            data: [followers, followings],
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });